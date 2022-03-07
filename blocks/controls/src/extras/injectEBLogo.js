export default () => {
	let node = document.querySelector(".edit-post-header__settings");
	let draftButton = document.querySelector(".editor-post-switch-to-draft");
	let exportButton = document.createElement("button");
	exportButton.id = "eb-export-icon";
	exportButton.className += "components-button components-icon-button";
	exportButton.innerHTML = `
  <?xml version="1.0" encoding="UTF-8"?>
  <svg width="24px" height="24px" viewBox="0 0 374 374" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <!-- Generator: Sketch 52.4 (67378) - http://www.bohemiancoding.com/sketch -->
      <title>EB logo</title>
      <desc>Created with Sketch.</desc>
      <defs>
          <path d="M135.028419,96 L238.971581,96 L239.468917,96.2161475 L239.841918,96.2161475 C246.058646,96.2161475 251.114841,98.9900125 255.010657,104.537826 C256.336892,106.843411 257,109.221009 257,111.670693 C257,117.650803 253.601573,122.261904 246.804618,125.504132 C244.483707,126.440776 242.16283,126.909091 239.841918,126.909091 L133.909414,126.909091 C128.936032,126.909091 124.542944,124.927759 120.730018,120.965035 C118.243327,118.083054 117,115.129068 117,112.102988 L117,110.806103 C117,106.050834 119.735319,101.980097 125.206039,98.5937699 C128.190068,97.0086804 131.132608,96.2161475 134.033748,96.2161475 L134.531083,96.2161475 L135.028419,96 Z M136.269504,173.272727 L194.347518,173.483254 C198.210421,173.483254 202.342768,175.027098 206.744681,178.114833 C210.248244,181.272743 212,184.711305 212,188.430622 C212,193.62363 208.90074,197.869202 202.702128,201.167464 C199.647739,202.57098 196.68323,203.272727 193.808511,203.272727 L135.056738,203.272727 C129.3073,203.272727 124.321534,201.027136 120.099291,196.535885 C118.033087,194.009557 117,191.483266 117,188.956938 L117,187.69378 C117,182.921826 120.189093,178.816604 126.567376,175.37799 C129.801435,174.114826 132.855778,173.483254 135.730496,173.483254 L136,173.483254 C136.17967,173.483254 136.269504,173.413079 136.269504,173.272727 Z M241.631579,173 L242.368421,173 C248.05266,173 252.508756,175.968168 255.736842,181.904594 C256.578952,184.024746 257,186.074195 257,188.053004 C257,193.989429 254.087748,198.547687 248.263158,201.727915 C246.157884,202.575976 244.298254,203 242.684211,203 L241.210526,203 C236.438573,203 232.368438,200.491191 229,195.473498 C227.66666,192.929316 227,190.420507 227,187.946996 C227,182.151914 229.877164,177.628992 235.631579,174.378092 C237.807028,173.459359 239.807008,173 241.631579,173 Z M135.028419,248.727273 L238.971581,248.727273 C238.971581,248.868616 240.256352,249.045293 242.825933,249.257308 C247.136197,250.176041 250.410291,251.836801 252.648313,254.23964 C255.549452,257.137181 257,260.458703 257,264.204305 C257,269.928715 253.601573,274.451638 246.804618,277.773209 C244.732376,278.409255 243.323272,278.727273 242.577265,278.727273 L131.422735,278.727273 C128.521596,278.727273 125.040281,277.066512 120.978686,273.744941 C118.326215,270.706056 117,267.631882 117,264.522326 L117,263.568262 C117,258.338554 120.108317,254.062978 126.325044,250.741407 C128.148618,249.822674 130.966825,249.186638 134.779751,248.83328 C134.779751,248.762608 134.86264,248.727273 135.028419,248.727273 Z" id="path-1"></path>
          <filter x="-28.9%" y="-14.0%" width="157.9%" height="144.3%" filterUnits="objectBoundingBox" id="filter-2">
              <feOffset dx="0" dy="15" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
              <feGaussianBlur stdDeviation="11" in="shadowOffsetOuter1" result="shadowBlurOuter1"></feGaussianBlur>
              <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.25 0" type="matrix" in="shadowBlurOuter1"></feColorMatrix>
          </filter>
      </defs>
      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g id="EB-Logo-Copy-2" transform="translate(-40.000000, -36.000000)">
              <g id="EB-logo" transform="translate(40.000000, 36.000000)">
                  <circle id="Oval-2" fill="#FFFFFF" cx="187" cy="187" r="187"></circle>
                  <g id="E">
                      <use fill="black" fill-opacity="1" filter="url(#filter-2)" xlink:href="#path-1"></use>
                      <use fill="#23282D" fill-rule="evenodd" xlink:href="#path-1"></use>
                  </g>
              </g>
          </g>
      </g>
  </svg>`;
	node.insertBefore(exportButton, draftButton);
};
