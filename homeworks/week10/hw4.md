## gulp 跟 webpack 有什麼不一樣？我們可以不用它們嗎？  
- gulp 和 webpack 兩者著重的開發概念不太相同。  
gulp 是「任務排程工具」，需要處理的檔案會依照配置文件 (gulpfile.js) 中的設定，經過排定的 plugins 依序處理，並生成最後的目標檔案。而 webpack 則是「模組封裝工具」，由在配置文件 (webpack.config.js) 中設定的 entry 開始，尋找依賴的資源，並將所有相依賴的模組檔案封裝成 bundle.js 或其他目標檔案。  
不過，透過 loader 和 plugins的使用， webpack 也能對非 js 的資源做處理，而 gulp 也能用 gulp-webpack 來引入 webpack 做排程，這兩個工具在功能上也有重疊的部分，能夠取兩邊最擅長好用的部分來用當然是最好。  
- gulp 可以把繁複的工作自動化，而 webpack 可以將複雜的專案模組化。不過只要願意多花時間和腦力處理，當然也可以不使用這兩個工具啦~~  

## hw3 把 todo list 這樣改寫，可能會有什麼問題？  
每次更動待辦事項都重新 render 整個 DOM 物件，多消耗了資源在重繪沒有做更動的部分。  
