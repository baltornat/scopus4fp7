function changeColor(val, current){
    let author;
    let bar;
    let head;
    let button;
    let values = val.split('-');
    let threshold = document.getElementById('customRange1').value;
    document.getElementById('textInput').value = current.toString()+"%";
    values.forEach(myFunction);
    function myFunction(item, index){
        author = "author"+index;
        bar = "bar"+index;
        head = "head"+index;
        button = "match-button"+index;
        if(parseFloat(item) >= threshold){
            document.getElementById(author).className="card shadow mb-4 border-bottom-success border-left-success";
            document.getElementById(bar).className="progress-bar bg-success";
            document.getElementById(head).className="h4 m-0 font-weight-bold text-success";
            document.getElementById(button).style="background-color: #1cc88a";
        }else{
            document.getElementById(author).className="card shadow mb-4 border-bottom-danger border-left-danger";
            document.getElementById(bar).className="progress-bar bg-danger";
            document.getElementById(head).className="h4 m-0 font-weight-bold text-danger";
            document.getElementById(button).style="background-color: #e74a3b";
        }
    }
}