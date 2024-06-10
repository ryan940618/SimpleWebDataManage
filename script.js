function showMsg(msg, type) {
    var msgContainer = document.createElement("div");
    msgContainer.className = "msg-container";
    
    var message = document.createElement("div");
    message.className = "message";
    message.textContent = msg;
    
	if (type == 0) {
        msgContainer.classList.add("er");
    }
	
    var countdownCircle = document.createElement("div");
    countdownCircle.className = "countdown-circle";
    
    msgContainer.appendChild(message);
    msgContainer.appendChild(countdownCircle);
    document.body.appendChild(msgContainer);

    setTimeout(function() {
        msgContainer.style.opacity = "0";
        setTimeout(function() {
            msgContainer.parentNode.removeChild(msgContainer);
        }, 300);
    }, 2000);

    var duration = 2;
    var start = null;
	
	function animateCircle(timestamp) {
        if (!start) start = timestamp;
        var progress = timestamp - start;
        var percentage = Math.min(progress / (duration * 1000) * 100, 100);
        countdownCircle.style.background = "conic-gradient(#fff " + percentage + "%, transparent 0%)";
        if (progress < duration * 1000) {
            requestAnimationFrame(animateCircle);
        }
    }
    requestAnimationFrame(animateCircle);
}

function initdate(){
	var today = new Date();
	
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
	var yyyy = today.getFullYear();

	today = yyyy + '-' + mm + '-' + dd;

	document.getElementById("date").value = today;
}