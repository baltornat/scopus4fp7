function showAll(first, last) {
    var i;
    var element;
    var title = document.getElementById("title");
    for (i=first; i<last; i++) {
        element = "col"+i;
        var x = document.getElementById(element);
        if (x.style.display === "none") {
            title.innerHTML = `Candidate authors (Shown ${last} of ${last})`;
            x.style.display = "block";
        } else {
            title.innerHTML = `Candidate authors (Shown ${first} of ${last})`;
            x.style.display = "none";
        }
    }
}