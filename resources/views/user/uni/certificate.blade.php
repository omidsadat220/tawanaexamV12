<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Certificate Preview</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/index.css" />

    <!-- CDN های لازم -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  </head>
  <body>
    <!-- certificate -->
    <div id="certificate" class="certificate-container">
      <!-- head*** -->
      <div class="cer-header">
        <div class="header-right-box"></div>
        <div class="header-title">Tawana Technology</div>
      </div>
      <!-- head*** -->
      <!-- name*** -->
      <div class="cer-name">
        <div class="name-box1">
          <span class="box1-h1">certificate</span>
          <span class="box1-h2">Of APPRECIATION</span>
          <span class="box1-h3">Proudly Present to :</span>
        </div>
        <div class="name-box1-logo">
          <img src="./img/logo.jpg" alt="" class="logo-img" />
        </div>
      </div>
      <!-- name*** -->
      <!-- person name*** -->
      <div class="text-container">
        <div class="container-dis">
          <h1 class="container-h1">Roman Noori</h1>
          <hr class="container-hr" />
          <p class="container-p1">
            Has successfully completed all requiements and criteria for
          </p>
          <p class="container-p2">
            <span class="span1">CCNA Enterprise</span>(<span class="span2"
              >Cisco Certified network Associate</span
            >)
          </p>
          <p class="container-p3">
            certification through Examination Administered By tawana Technology.
          </p>
        </div>
        <div class="container-logos">
          <div class="logos-borcode">
            <img class="barcode-img" src="./img/barcode.png" alt="" />
          </div>
          <div class="logos-id-number">
            <h3 class="cer-num">
              Certification Num
              <span style="color: #000; letter-spacing: 0px">T-211212</span>
            </h3>
            <a href="https://tawanatechnology.com/" class="cer-link"
              >https://tawanatechnology.com/certificate</a
            >
            <h4 class="cer-date">
              Date of achievment:
              <span style="color: #000; letter-spacing: 0px">
                January3,2026</span
              >
            </h4>
          </div>
          <div class="logos-syncher">
            <img class="syncher-img" src="./img/syncher.png" alt="" />
          </div>
          <div class="logos-compani">
            <img src="./img/1-2.png" alt="" class="compani" />
          </div>
        </div>
      </div>
      <!-- person name*** -->
      <div class="footer-design"></div>
      <!-- cer-bottom-right -->
      <div class="cer-bottom-right">
        <div class="bt-ri-box1"></div>
        <div class="bt-ri-box2"></div>
        <div class="bt-ri-box3"></div>
      </div>
    </div>
    <!-- certificate -->
    <button onclick="downloadPDF()">📄 Download PDF</button>

    <script>
      async function downloadPDF() {
        const { jsPDF } = window.jspdf;
        const element = document.getElementById("certificate");

        // اسکرین‌شات از عنصر
        const canvas = await html2canvas(element, { scale: 2 });
        const imgData = canvas.toDataURL("image/png");

        // ایجاد PDF
        const pdf = new jsPDF("landscape", "mm", "a4");
        const pageWidth = pdf.internal.pageSize.getWidth();
        const pageHeight = pdf.internal.pageSize.getHeight();

        pdf.addImage(imgData, "PNG", 0, 0, pageWidth, pageHeight);
        pdf.save("Certificate.pdf");
      }
    </script>
  </body>
</html>
