

/* CATALOG FILTER */
filterSelection('all')
function filterSelection(c) {
    var x, i;
    x = document.getElementsByClassName("filterDiv");
    if (c === "all") {
      let divVisible = [];
      for (i = 0; i < x.length; i++) {
        let arr = x[i].className;
        let Name = arr.split(' ');
        divVisible.push(Name[0]);
        // FilterRemoveClass(x[i], "show");
        FilterRemoveClass(x[i], "show");
      }
      const unique = divVisible.filter((v, i, a) => a.indexOf(v) === i);
      const even = (x) => FilterAddClass(document.getElementsByClassName(x)[0],'show');
      unique.some(even);
      return ;
    }
    for (i = 0; i < x.length; i++) {
      FilterRemoveClass(x[i], "show");
      if (x[i].className.indexOf(c) > -1) FilterAddClass(x[i], "show");
    }

}

function FilterAddClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
    }
}

function FilterRemoveClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
        arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
    }
    element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
// var btnContainer = document.getElementById("myBtnContainer");
// var btns = btnContainer.getElementsByClassName("btnfilter");
// for (var i = 0; i < btns.length; i++) {
//     btns[i].addEventListener("click", function(){
//     var current = document.getElementsByClassName("active");
//     current[0].className = current[0].className.replace(" active", "");
//     this.className += " active";
//     });
// }
// /* END CATALOG FILTER */


function scroll_to(clicked_link, nav_height) {
	var element_class = clicked_link.attr('href').replace('#', '.');
	var scroll_to = 0;
	if(element_class != '.top-content') {
		element_class += '-container';
		scroll_to = $(element_class).offset().top - nav_height;
	}
	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 1000);
	}
}

