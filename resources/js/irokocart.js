/**
 * 
 */
function ajaxSendCartData(pId) {
	var xhttp;
	if (window.XMLHttpRequest) {
		xhttp = new XMLHttpRequest();
	} else {
		xhttp = new ActieXObject("Microsoft.XMLHTTP");
	}
	xhttp.open("POST", "addcart.php", true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var label = document.getElementById("cart-icon-span");
            var cartValue = this.responseText;
			label.innerHTML = cartValue;
		}
	}
	var pId = encodeURIComponent(pId);
	xhttp.send("cartitem=" + pId);
}