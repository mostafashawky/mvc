//variable environment

// Toggle Sidebar Icon
let toggleIconsidebar = document.querySelector('#toggle'); 

// Sidebar Element
let sidebar = document.querySelector("#sidebar");

// Toggle Submenu Links
let toggleSubmenu = Array.from( document.querySelectorAll(".toggle-submenu") );

// Wrapper Action
let wrapperAction = document.querySelector(".wrapper-action");





// All Function
// Handle Sidebar ( Close And Open )
toggleIconsidebar.addEventListener('click', function(){	
	// Close Sidebar
	this.classList.toggle('off') 

	// Check If This Element Contain Class Off 
	if( this.classList.contains('off') ) { 
		sidebar.classList.add('none');
		wrapperAction.classList.add('none');
		this.children[0].style.transform = "rotate(90deg)";
	} else {
		sidebar.classList.remove('none');
		wrapperAction.classList.remove('none');
		this.children[0].style.transform = "rotate(0deg)";
	}	
})

// Handle Sidebar SubMenu
toggleSubmenu.forEach( ( menu )=>{
	menu.addEventListener('click', function(){
		this.nextElementSibling.classList.toggle('active') 
	})
})

