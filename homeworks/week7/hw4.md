## Bootstrap 是什麼？  
Boorstrap 是包含 CSS、JavaScript 的前端框架，提供了許多預設的元件和風格樣式設定，讓網頁開發可以更快速。官方有提供編譯好的 css 及 js 檔案以方便導入專案，但如果不想讓網頁風格跟其他使用 Boorstrap 預設樣式的網站太過一致的話，也可透過修改官方提供的 sass 原始碼中相關變數的方式客製樣式。


## 請簡介網格系統以及與 RWD 的關係  
網頁設計上的網格系統是指將網頁劃分成固定寬度等分的 column，並讓網頁上元件寬度符合指定倍數的 column，而不需要個別指定元件的寬度。在 RWD 應用上，可以為元件在不同螢幕大小上指定合適的 column 數，以達到大螢幕可以顯示較多內容，而小螢幕內容需要放大的效果。  
以 Bootstrap 的 12 欄系統為例，如果設定 `<div class="col-sm-12 col-lg-6>`，則這個 `div` 在螢幕寬度大於 992px 時，寬度會佔據 1/2 個 container，在螢幕寬度 991~576px 時，`div` 的寬度會佔據整個 container。


## 請找出任何一個與 Bootstrap 類似的 library  
- Foundation by ZURB
- Materialize by Google

## jQuery 是什麼？  
JavaScript 的 library，定義了許多操作 HTML DOM 物件、CSS、AJAX 的函式，以大量簡化 JavaScript 在這些部分之間的操作。

## jQuery 與 vanilla JS 的關係是什麼？  
jQuery 是 Javascript 的一種函式庫，而 Vanilla JS 就是使用原生 javscript 的意思。 jQuery 簡化了 JavaScript 操作網頁元件的步驟，但 jQuery 可以做的，也都能用 Vanilla JS 完成，而且可能執行的效率更好一點。所以應該可以說 jQuery 是簡便取向，而 Vanilla JS 是效能取向。

