<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Certificate Preview</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('certificate/css/index.css') }}" />

    <!-- CDN های لازم -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  </head>
  <body>
    <!-- certificate -->
    <div id="certificate" class="certificate-container">
      <!-- head*** -->
      <div class="cer-header">
        {{-- <div class="header-right-box"></div> --}}
        <div class="header-title">Tawana Technology</div>
      </div>
      <!-- head*** -->
      <!-- name*** -->
      <div class="cer-name">
        <div class="name-box1">
          <span class="box1-h1">certificate</span>
          <span class="box1-h2">Of Achievement</span>
          {{-- <span class="box1-h3">Proudly Present to :</span> --}}
        </div>
        <div class="name-box1-logo">
          <img src="{{ asset('certificate/img/logo.jpg') }}" alt="" class="logo-img" />
        </div>
      </div>
      <!-- name*** -->
      <!-- person name*** -->
      <div class="text-container">
        <div class="container-dis">
          <h1 class="container-h1"><?php echo Auth::user()->name?></h1>
          <hr class="container-hr" />
          <p class="container-p1">
           This is to certify that [<span style="color: #78c405; font-weight: bold; font-style: italic;">
    <?php echo Auth::user()->name; ?>
</span> ] has successfully completed <br> the online examination for.
          </p>
          <p class="container-p2">
            <span class="span1">Seminar</span>(<span class="span2"
              >Cyber Security</span
            >)
          </p>
          <p class="container-p3">
           This certificate is awarded in recognition of their dedication, knowledge, and successful performance.

          </p>
        </div>
        <div class="container-logos">
          <div class="logos-borcode">
            <img class="barcode-img" src="{{ asset('certificate/img/barcode.png') }}" alt="" />
          </div>
          <div class="logos-id-number">
            {{-- <h3 class="cer-num">
              Certification Num
              <span style="color: #000; letter-spacing: 0px">T-211212</span>
            </h3> --}}
            <a href="https://tawanatechnology.com/" class="cer-link"
              >https://tawanatechnology.com</a
            >
            <h4 class="cer-date">
              Date of achievment:
              <span style="color: #000; letter-spacing: 0px">
                  {{ \Carbon\Carbon::now()->format('F j, Y') }}
              </span>
            </h4>
          </div>
          <div class="logos-syncher">
            <img class="syncher-img" src="{{ asset('certificate/img/syncher.png') }}" alt="" />
          </div>
          <div class="logos-compani">
            <img src="{{ asset('certificate/img/logo.png') }}" alt="" class="compani" />
          </div>
        </div>
      </div>
      <!-- person name*** -->
      <div class="footer-design"></div>
      <!-- cer-bottom-right -->
      {{-- <div class="cer-bottom-right">
        <div class="bt-ri-box1"></div>
        <div class="bt-ri-box2"></div>
        <div class="bt-ri-box3"></div>
      </div> --}}
    </div>
    <!-- certificate -->
    <button onclick="downloadPNG()">🖼️ Download PNG</button>

<script>
async function downloadPNG() {
  const element = document.getElementById("certificate");

  // Use html2canvas with high scale for quality
  const canvas = await html2canvas(element, {
    scale: 3,           // Increase resolution
    useCORS: true,      // Load external images
    allowTaint: true,   // Keep styles intact
    logging: true
  });

  // Convert to PNG
  const imgData = canvas.toDataURL("image/png");

  // Create a temporary link to download
  const link = document.createElement("a");
  link.href = imgData;
  link.download = "Certificate.png";
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}
</script>
  </body>
</html>
