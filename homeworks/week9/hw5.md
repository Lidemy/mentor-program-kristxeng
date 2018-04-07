## CSS 預處理器是什麼？我們可以不用它嗎？  
- CSS 預處理器是指以特定語法編寫，經編譯後仍以產生原生 CSS 檔案為目的的程式。CSS 預處理器的主要是為了彌補 CSS 原生語法上的不足或是缺憾之處，例如：變數、巢狀、模組化開發、函式、繼承等。  
- CSS 預處理器是為了用更便捷的方式產生CSS檔案，但最終目的還是生成原生的CSS，使用 CSS 預處理器可以做到的事，原生 CSS 當然也都可以做到，所以 CSS 預處理器是選項但不是必然。  

## 請舉出任何一個跟 HTTP Cache 有關的 Header 並說明其作用。
- `Expires`：快取的到期時間。  
- `Cache-Control: max-age=60`：代表這個 Response 在 60 秒之內，快取有效。
- `Cache-Control: no-cache`：每次使用快取前，需要重新驗證快取的有效性。
- `Cache-Control: no-store`：不使用快取。
- `Last-Modified`：Server 回傳 Response 時，可加上此 Header 來表示此檔案最後修改的時間。  
- `If-Modified-Since`：當快取快過期時，Client 發送 Request 時會將之前收到的`Last_modified`時間資訊加在此 Header，讓 Server 判斷此資源是否更改，如果未更改則回傳 `Status Code: 304 (Not Modified)`，代表此快取仍有效，反之則回傳更新後的資源。  
- `Etag`：類似檔案的hash值，用以讓 Server 端判斷快取檔案有效性。
- `If-None-Match`：快取過期後，Client 會將之前收到的 Etag 值附加在此 Header 中，向 Server 詢問是否有不符合此 Etag 的新資料，如果有則回傳新資料，反之則回傳 304。  

## Stack 跟 Queue 的差別是什麼？  
Stack 就像是只有一個開口的儲物櫃，舊資料總是會被更新的資料塞得更內層一點，所以放進去的資料，得將較新的資料拿出來之後，才能被拿出來 (FILO, First-In-Last-Out)。而 Queue 像是入口跟出口分開的儲物櫃，放進去的資料可以依照放進去的順序被拿出來 (FIFO, First-In-First_out)。  

