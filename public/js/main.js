//variable environment
let toggleIcon = document.querySelector('#toggle');
let sidebar = document.querySelector("#sidebar");
let link = document.querySelectorAll('.link');
let toggleMenu = Array.from( document.querySelectorAll(".toggle-menu") );
let toggleMenulist = document.querySelector(".toggle-menu + ul")
let wrapperAction = document.querySelector(".wrapper-action");
//sidebar icon
toggleIcon.addEventListener('click', function(){
	this.classList.toggle('off') // close sidebar

	if( this.classList.contains('off') ) { //check if this element contain class off 
		sidebar.classList.add('none');
		wrapperAction.classList.add('none');
		this.children[0].style.transform = "rotate(90deg)";
	} else {
		sidebar.classList.remove('none');
		wrapperAction.classList.remove('none');
		this.children[0].style.transform = "rotate(0deg)";

	}	
})

toggleMenu.forEach( ( menu )=>{
	menu.addEventListener('click', function(){
		this.nextElementSibling.classList.toggle('active') 
	})
})

