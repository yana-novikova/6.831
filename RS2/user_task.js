var Task = function(menu, item, display) {
    ////////////////////////////////////////////////
    // Representation
    //
	

	this.menu = menu;			
	this.item = item;
	this.display = display;
	

	////////////////////////////////////////////////
	// Public methods
	//

	this.toString = function(){			
		return menu + "_" + item + "_" + display;
	}
}