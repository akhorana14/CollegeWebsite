/** Imports ** /




/** Default Styles **/
a {
	text-decoration: none;
	color: inherit;
}
ul, ol, li {
	list-style: none;
}


.topnav {
position:fixed;
	top:0;
	left:0;
	width:100%;
  text-align:right;
  font-family: 'Lato', sans-serif;
  background-color: #292684;
  color: #e0e0e0;
  overflow: hidden;
}

.topnav a {
  float: right;
  color: #e0e0e0;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}
.topnav a:hover {
  color: white;
}
.dropdown {
	display: table;
	width: 90px;
	background-color: gray;
	color: white;
	float: right;
	box-shadow: 3px 3px 10px black;

}
#dropdown-content {
	display: none;
	padding: 5px;
	font-size: 1.1em;
	padding-left: 0px;
	text-align: center;
	font-family: 'Lato', sans-serif;
}
a#user:hover .dropdown-content {
	display: block;
}
a {
	    color: #e0e0e0;

}
a:hover {
	color: white;
}

body {
	background-color: #397fef;
	/*background-image: url(""); */
	background-repeat: no-repeat;
}



/** Body Styles **/
h1#name {
	position: fixed;
	top:10%;
	left:37%;
	font-size: 4em;
	color: #ffffff;
	font-weight: bold;
	font-family: 'Lato', sans-serif;
}
input.search {
	position: fixed;
	top: 45%;
	left:33%;
	text-align: left;
	font-size: 1.5em;
	width: 23em;

}
input.search a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

input.search {
  background-color: #ddd;
  color: black;
  z-index: -99;
}
input#search {
	position: fixed;
	width: 4em;
	height: 3.27em;
	top:45%;
	left: 70%;
	background-image: url("https://images.vexels.com/media/users/3/143356/isolated/preview/64e14fe0195557e3f18ea3becba3169b-search-magnifying-glass-by-vexels.png");
	z-index: -98;
}
img#search {
	position: fixed;
	width: 38px;
	height: 38px;
	top:45%;
	left: 70%;
	background-image: url("https://images.vexels.com/media/users/3/143356/isolated/preview/64e14fe0195557e3f18ea3becba3169b-search-magnifying-glass-by-vexels.png");
}
video {
	position: fixed;
	min-height:100%;
	min-width:100%;
	 right: 0;
  	bottom: 0;
  	z-index: -100;
}

/* OVERLAY! */




/** Footer Styles **/




/** Animations and Keyframes **/ 