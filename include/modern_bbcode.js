
/* =================================================================== */
/* 		MOD "MODERN BBCODE" JAVASCRIPT FUNCTIONS 	       */
/* 			    Author: neutral 	       		       */
/* =================================================================== */

/* ======================= */
/* Common script variables */
/* ======================= */

var uagent    = navigator.userAgent.toLowerCase();
var is_safari = ((uagent.indexOf('safari') != -1) || (navigator.vendor == "Apple Computer, Inc."));
var is_opera  = (uagent.indexOf('opera') != -1);
var is_webtv  = (uagent.indexOf('webtv') != -1);
var is_ie     = ((uagent.indexOf('msie') != -1) && (!is_opera) && (!is_safari) && (!is_webtv));

var menu_ids = new Array(0, 1, 2, 3, 4);

var dropdown_buttons = new Array(
	"color", "smiley", "size", "img", "list"
);

var popup_panels = new Array(
	"colorpalette",	"smilespanel", "sizepanel", "imgpanel",	"listpanel"
);

var opened_popup = -1;

// only for ie fix
var none_ie = new Array(
	"colorbtn", "smilesbtn", "sizebtn", "imgbtn", "listbtn"
);

var none_ie_2 = new Array(
	"colorcontent", "smilescontent", "sizecontent", "imgcontent", "listcontent"
);

/* =========================================== */
/* This function fixes toolbar width for Opera */
/* =========================================== */

function fixOperaWidth()
{
	if (is_opera) 
	{
		document.getElementById('bbcode').style.width = "99%";
		document.getElementById('bbcode_adv').style.width = "99%";
	}
}

/* ================================ */
/* Returns left posititon of object */
/* ================================ */

function getObjectLeftpos (obj)
{
	var left = obj.offsetLeft;
	
	while ((obj = obj.offsetParent) != null)
	{
		left += obj.offsetLeft;
	}
	
	return left;
}

/* ================================ */
/* Returns top posititon of object  */
/* ================================ */

function getObjectToppos(obj)
{
	var top = obj.offsetTop;
	
	while ((obj = obj.offsetParent) != null)
	{
		top += obj.offsetTop;
	}
	
	return top;
}


/* ============================ */
/* Generates list tag structure */
/* ============================ */

function tag_list( type )
{
	var listitem = "init";
	var thelist   = "";
	
	opentag = ( type == 'ordered' ) ? '[listo]' : '[list]';
	closetag = ( type == 'ordered' ) ? '[/listo]' : '[/list]';
	
	while ((listitem != "") && (listitem != null))
	{
		listitem = prompt(list_prompt, "");
		
		if ((listitem != "") && (listitem != null))
		{
			thelist = thelist + "[li]" + listitem + "[/li]";
		}
	}
	
	if ( thelist != "" )
	{
		thelist = opentag + thelist + closetag;
		insert_text(thelist, "");
	}
}

/* =================== */
/* Hides poped up menu */
/* =================== */

function hide_poped_menu()
{
	if (opened_popup >= 0)
	{
		var btn_id = dropdown_buttons[opened_popup];
		var popup_id = popup_panels[opened_popup];

		document.getElementById(popup_id).style.visibility = "hidden";
		document.getElementById(popup_id).style.display    = "none";

		opened_popup = -1;
		document.getElementById(btn_id).className = 'dropdown';
	}
}

function documentClickHandler(target)
{
	for (var i = 0; i < menu_ids.length; i++)
	{
		if (target.id == dropdown_buttons[i])
			return true;
	}

	if (target.className == "abtn")
		return true;

	hide_poped_menu();
	return true;
}

/* ===================================== */
/* Shows popup menu specified by menu_id */
/* ===================================== */

function popup_menu(menu_id)
{
	var btn_id = dropdown_buttons[menu_id];

	btnElement = document.getElementById(btn_id);

	var iLeftPos  = getObjectLeftpos(btnElement);
	var iTopPos   = getObjectToppos(btnElement) + (btnElement.offsetHeight - 1);

	if (is_ie) 
	{
		iLeftPos += 3;
		iTopPos += -9;
	}

	var popup_id = popup_panels[menu_id];

	document.getElementById(popup_id).style.left = (iLeftPos) + "px";
	document.getElementById(popup_id).style.top  = (iTopPos)  + "px";

	if (opened_popup == menu_id)
	{
		hide_poped_menu();
		return;
	}

	hide_poped_menu();

	document.getElementById(popup_id).style.visibility = "visible";
	document.getElementById(popup_id).style.display    = "inline";

	document.getElementById(btn_id).className = 'dropdown_opened';
	if (is_ie)
	{
		document.getElementById(none_ie[menu_id]).style.visibility = "hidden";
		document.getElementById(none_ie_2[menu_id]).className = "popupcontent_ie";
	}

	opened_popup = menu_id;
	
	return;
}

function mouseover_menu(menu_id)
{
	if (opened_popup < 0)
		return;

	if (opened_popup != menu_id)
		popup_menu(menu_id);
}