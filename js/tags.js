$(document).ready(function() {
$('.ui-menu').css('margin-left', $('#conff_text').position().left);

var availableTags = [
    "ActionScript",
    "AppleScript",
    "Asp",
    "BASIC",
    "C",
    "C++",
    "Clojure",
    "COBOL",
    "ColdFusion",
    "Erlang",
    "Fortran",
    "Groovy",
    "Haskell",
    "Java",
    "JavaScript",
    "Lisp",
    "Perl",
    "PHP",
    "Python",
    "Ruby",
    "Scala",
    "Scheme"
    ];

var availableUsers = [
    "nljuggler",
    "Steeve17",
    "StackOverflow"];

function split(val) {
    return val.split(/[@|#]\s*/);
}
function splita(val) {
    return val.split(' ');
}

function extractLast(term) {
    return split(term).pop();
}

$("#conff_text").bind("keydown", function(event) {
    if (event.keyCode === $.ui.keyCode.TAB && $(this).data("autocomplete").menu.active) {
        event.preventDefault();
    }
}).autocomplete({
    minLength: 0,
    source: function(request, response) {
        var term = request.term,
            results = []; 
        if (term.indexOf("#") >= 0) {
			
            term = extractLast(request.term);
			//alert($("#tags").getCursorPosition());
			//alert($('#conff_text').val());
			$('#label').text($('#conff_text').val());
			//var positionoftext = 
			//alert($('#label').width());
			var position = $('#conff_text').position();
			$('.ui-menu').css('margin-top', position.top+25+'px');
			$('.ui-menu').css('margin-left', ($('#conff_text').width()+$('#label').position().left-30+'px'));
            if (term.length > 0) {
                results = $.ui.autocomplete.filter(
                tags, term);
				
            } else {
                results = ['Start typing...'];
            }
        }  
        if (term.indexOf("@") >= 0) {
            term = extractLast(request.term);
			
            if (term.length > 0) {
                results = $.ui.autocomplete.filter(
                 availableUsers, term);
            } else {
                results = ['Start typing...'];
            }
        } 
        response(results);
    },
    focus: function() {
        // prevent value inserted on focus
        return false;
    },
    select: function(event, ui) {
        var terms = splita(this.value);
		
        // remove the current input
        terms.pop();
        // add the selected item
		
        terms.push('#'+''+ui.item.value);
		//alert(ui.item.value);
        // add placeholder to get the comma-and-space at the end
        terms.push("");
        this.value = terms.join(" ");
        return false;
    }
});
});
