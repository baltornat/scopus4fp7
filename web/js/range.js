function changeColor(val, current){
    let author;
    let bar;
    let head;
    let values = val.split('-');
    let threshold = document.getElementById('customRange1').value;
    document.getElementById('textInput').value = current.toString()+"%";
    values.forEach(myFunction);
    function myFunction(item, index){
        if(parseFloat(item) >= threshold){
            author = "author"+index;
            bar = "bar"+index;
            head = "head"+index;
            document.getElementById(author).className="card shadow mb-4 border-bottom-success border-left-success";
            document.getElementById(bar).className="progress-bar bg-success";
            document.getElementById(head).className="h4 m-0 font-weight-bold text-success";
        }else{
            author = "author"+index;
            bar = "bar"+index;
            head = "head"+index;
            document.getElementById(author).className="card shadow mb-4 border-bottom-danger border-left-danger";
            document.getElementById(bar).className="progress-bar bg-danger";
            document.getElementById(head).className="h4 m-0 font-weight-bold text-danger";
        }
    }
}