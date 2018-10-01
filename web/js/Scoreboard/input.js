function add3() {
	var score = document.getElementById("p").textContent
	score = +score + 3
	document.getElementById("p").innerHTML = score
    }

    function add2() {
    	var score = document.getElementById("p").textContent
	score = +score + 2
	document.getElementById("p").innerHTML = score
    }

    function add1() {
	var score = document.getElementById("p").textContent
	score = +score + 1
	document.getElementById("p").innerHTML = score
    }

    function min() {
    	var score = document.getElementById("p").textContent
	score--
	document.getElementById("p").innerHTML = score
    }
