
// Stack 實作
function Stack(){

	var arr = [];

	this.push = function(s){

		arr.push(s);
	}

	this.pop = function(){

		return arr.pop();
	}

}


// Queue 實作
function Queue(){

	var arr = [];

	this.push = function(q){

		arr.push(q);
	}

	this.pop = function(){
		
		return arr.shift();
	}
}


// 題目測試
var stack = new Stack()
stack.push(10)
stack.push(5)
console.log(stack.pop()) // 5
console.log(stack.pop()) // 10

var queue = new Queue()
queue.push(1)
queue.push(2)
console.log(queue.pop()) // 1
console.log(queue.pop()) // 2