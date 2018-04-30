## 為什麼我們需要 React？可以不用嗎？  
React 是一個專注處理 View 的 JavaScript Library，理論上不使用它，當然也可以做到一樣的功能，因為最終都還是會產出一般瀏覽器看得懂的 JavaScript 檔案嘛。不過，就像同樣目的都是到高雄，一步一步用腳走過去，雖然可能更能體會沿途風光，並且獲得滿滿的回憶，但如果顧及效率跟舒適性，坐高鐵應該是更適合的選項。

## state 跟 props 的差別在哪裡？  
- state 是指在元件內部的狀態值，在元件內部可以用 setState 更改 state 的值，每當使用 setState 方法改變 state 時，就會重新 render 元件。  
- props 是指在元件實例化時，由父元件傳進來的參數。也因為是外部傳進來的，在元件內部並不能變更它。  

## 請列出 React 的 life cycle 以及其代表的意義（componentWillMount...）  
React Component 的 life cycle 大致分為，Mounting、Updating、Unmounting，而其中相關的 Method 如下：  

#####Mounting ( Component 實例被創建並插入 DOM )  
- componentWillMount：此 Method 會在 Component 初始化 render() 之前被呼叫。此 Method 將會被更名為 UNSAFE_componentWillMount。  
- componentDidMount：此 Method 會緊接著 Component 初始化的 render() 之後執行，此函式內適合設定 AJAX 或是綁定 Time Event。  

#####Updating ( 已載入的 Component 在收到新的 state 或 props時重新渲染。相關 Method 在初始化渲染時都不會被呼叫 )  
- componentWillReceiveProps：已經載入的 Component 收到新的 props 會呼叫此 Method，此 Method 將改名為 UNSAFE_componentWillReceiveProps，且官方推薦改用 getDerivedStateFromProps。  
- shouldComponentUpdate：React 預設在每次狀態改變時重新渲染，當 shouldComponent 返回 false 時，會改變這個預設設定，讓 元件不重新渲染，後續的componentWillUpdate()、render()、componentDidUpdate()也都因此不會被呼叫。  
- componentWillUpdate：在收到新的 props 或 state，元件將要重新渲染之前，會呼叫此 Method。此 Method 將改名為 UNSAFE_componentWillUpdate。  
- componentDidUpdate：在元件重新渲染之後會立即呼叫此 Method。  

#####Unmounting ( 卸載已載入的 Component )  
- componentWillUnmount：在元件卸載之前會呼叫此 Method，因此在此 Method 內適合處理必要的清理程序，如解除 Timer、取消遠端請求等。  
