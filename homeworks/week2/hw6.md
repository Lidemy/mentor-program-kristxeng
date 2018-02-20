## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。     
-  `<iframe>`：崁入其他URL的網頁內容，常用在崁入facebook、youtube等頁面方塊。   
- `<canvas>`：畫布元素，可以利用javascript在其空間內繪製圖形。  
- `<input>`：網頁使用者的輸入欄位。

## 請問什麼是盒模型（box modal）
- 在網頁文件中，每個元素都可被看做是一個矩形的盒子，而這個盒子描述了該元件所占空間內容。除了元素實際內容之外，由內而外依序以 padding、border、margin 層層包覆。  
- 使用預設盒模型時 (`box-sizing: content-box`)，元素所占空間寬度應為 width + (padding x2) + (border x2) + (margin x2) ，元素所占高度亦同。  
- 使用 `box-sizing: border-box` 設定時，width 及 height 已包含 padding 及 border。  

## 請問 display: inline, block 跟 inline-block 的差別是什麼？
- 使用`display: block` 時，該元素獨佔一行，如果沒有設定寬度，其會盡可能佔滿容器。  
- `display: inline` 表示為「行內元素」，在寬度允許情況下，會與其他元素顯示為同一行，無法個別設定 width、height 以及上下的margin、border、padding。  
- 設定為 `display: inline-block` 時，既具有區塊元素的寬高特性，又具有行內元素可與其他元素同行的特性。  

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
- `position: static`：指網頁元素排列的預設值，為由上至下，由左至右的排版方式。  
- `position: relative`：在沒有增加額外屬性設定時，表現同 `position: static`。如果增加 `top`、`right`、`bottom`、`left`等設定時，會使該元素依原本該顯示的位置做調整，而此元素移動的空間並不會影響其他元素的位置。  
- `position: absolute`：當套用此定位設定元素的上層容器為非 `position: static` 元素時，absolute 元素的定位為上層容器的相對位置。如果上層元素套用 `position: static` 的話，則以 `<body` 元素作相對位置定位。  
- `position: fixed`：以瀏覽器視窗作相對位置定位，不受畫面卷軸滾動影響。  
