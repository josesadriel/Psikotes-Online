<script src="https://cdn.jsdelivr.net/npm/chart.js@3.1.1/dist/chart.min.js"></script>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<div id='doc'>
    <p>Hello world</p>
    <div class="first-page">
        <h1>bond</h1>
        <img src="1.png" />
    </div>
    <div class="second-page">
        <img src="2.png" />
    </div>
</div>
<button onclick="saveDoc()">click</button>

<script type="text/javascript">
    var pdf = new jsPDF('p', 'pt', 'a4');

    function saveDoc() {
        window.html2canvas = html2canvas
        const doc = document.getElementsByTagName('div')[0];

        if (doc) {
            console.log("div is ");
            console.log(doc);
            console.log("hellowww");



            pdf.html(document.getElementById('doc'), {
                callback: function(pdf) {
                    pdf.save('DOC.pdf');
                }
            })
        }
    }
</script>