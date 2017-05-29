window.onload = function(){
		var bead = document.getElementsByClassName('bead');
		
		for (var i = 0; i < bead.length; i++){
			var bea = bead[i];
			bea.onclick = function(){
				if(this.style.cssFloat == "left"){
					this.style.cssFloat = "right";
				} else {
					this.style.cssFloat = "left";
				}
			}
		}
	}