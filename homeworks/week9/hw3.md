###在 JavaScript 裡面，一個很重要的概念就是 Event Loop，是 JavaScript 底層在執行程式碼時的運作方式。請你說明以下程式碼會輸出什麼，以及盡可能詳細的解釋原因。  
```
console.log(1)
setTimeout(() => {
  console.log(2)
}, 0)
console.log(3)
setTimeout(() => {
  console.log(4)
}, 0)
console.log(5)
```

**輸出**  
1  
3  
5  
2  
4  

**程式碼的內部執行步驟應如下所述：**  
1. 將`console.log(1)`塞進 Call Stack 並執行，執行結果輸出 1  
2. 將 setTimeout 塞進 Call Stack 並執行，執行結果會在 Web API 設一個計時器，但因為是 0 秒計時器，因此馬上將包含 `console.log(2)`的匿名函式 排進 Callback Queue  
3. 將`console.log(3)`塞進 Call Stack 並執行，執行結果輸出 3  
4. 將第二個 setTimeout 塞進 Call Stack 並執行，執行結果將包含`console.log(4)`的匿名函式排進 Callback Queue  
5. 將`console.log(5)`塞進 Call Stack 並執行，執行結果輸出 5  
6. 此時 Call Stack 已清空，Event Loop 將 Callback Queue 中第一個程序(即包含 `console.log(2)`的匿名函式)排入 Call Stack 並執行，執行結果輸出 2  
7. Event Loop 再將 Callback Queue 中剩下的程序(即包含 `console.log(4)`的匿名函式)排入 Call Stack 並執行，執行結果輸出 4  
