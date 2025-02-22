
<html style="background: #0c0d0c">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.5.136/pdf_viewer.min.css"
        integrity="sha512-dbJOtZ3VfH52HMyZ0hz6HcLVK0bESRU396ht5fz4EC6icMeT0MKSYxp6LoydBDaMUHiAGjnI9vA3hZRcCc2Fxw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            margin: 0;
            padding: 0;
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #pdfContainer {
            flex-grow: 1;
            width: 100%;
        }

        .pdfPage {
            display: block;
            margin: 20px auto;
        }

        .download-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            z-index: 1000;
        }

        .download-button:hover {
            background-color: #2980b9;
        }

        .size-6 {
            width: 20px;
            height: 20px;
        }

        .footer {
            background-color: #111;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .footer a {
            color: #3498db;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Download Button -->
    <button class="download-button" onclick="downloadPDF()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
        </svg>
    </button>

    <!-- PDF Container -->
    <div id="pdfContainer"></div>

    <!-- Footer -->
    <div class="footer">Powered by <a href="https://designekta.com">Designekta Studios</a></div>

    <script>
        const url = "{{url('/')}}/uploads/shaqs-bites.pdf";
        let pdfDoc = null;
        const scale = 1.5; // Adjust this scale for better readability
        const container = document.getElementById("pdfContainer");

        function renderPage(page) {
            const viewport = page.getViewport({
                scale: scale
            });
            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d");
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            canvas.className = "pdfPage";

            const renderContext = {
                canvasContext: context,
                viewport: viewport,
            };

            container.appendChild(canvas);
            page.render(renderContext);
        }

        pdfjsLib.GlobalWorkerOptions.workerSrc =
            "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js";

        pdfjsLib.getDocument(url).promise.then((pdfDoc_) => {
            pdfDoc = pdfDoc_;

            for (let pageNum = 1; pageNum <= pdfDoc.numPages; pageNum++) {
                pdfDoc.getPage(pageNum).then(renderPage);
            }
        });

        function downloadPDF() {
            const link = document.createElement("a");
            link.href = url;
            link.download = "{{url('/')}}/uploads/shaqs-bites.pdf";
            link.click();
        }
    </script>
</body>

<script>'undefined'=== typeof _trfq || (window._trfq = []);'undefined'=== typeof _trfd && (window._trfd=[]),_trfd.push({'tccl.baseHost':'secureserver.net'},{'ap':'cpsh-oh'},{'server':'p3plzcpnl505670'},{'dcenter':'p3'},{'cp_id':'10027206'},{'cp_cl':'8'}) // Monitoring performance to make your website faster. If you want to opt-out, please contact web hosting support.</script><script src='https://img1.wsimg.com/traffic-assets/js/tccl.min.js'></script></html>
