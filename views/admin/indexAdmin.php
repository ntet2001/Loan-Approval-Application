<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--link call bootstrap css-->
    <link rel="stylesheet" href="../dist/css/bootstrap.css">
    <link rel="stylesheet" href="./headerAdmin/headerAdmin.css">
    <style>
        main{
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
        <!--call bootstrap javascript-->
    <script src="../dist/jquery/jquery-3.6.0.min.js"></script>
    <script src="../dist/js/bootstrap.js"></script>
    <script src="../dist/js/popper.min.js"></script>
</head>
<body>
    <!---header pour ma navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
            <div class="container-fluid">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#monMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="monMenu">
                    <!--dropdown pour fichier-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Files</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="./fichier/reseau/indexReseau.php">Network</a>
                            <a class="dropdown-item" href="./fichier/section/indexSection.php">Section</a>
                            <a class="dropdown-item" href="./fichier/pole/indexPole.php">Pole</a>
                            <a class="dropdown-item" href="./fichier/agence/indexAgence.php">Agency</a>
                            <a class="dropdown-item" href="./fichier/document/indexDocument.php">Documents</a>
                            <a class="dropdown-item" href="./fichier/client/indexClient.php">Customers</a>
                            <a class="dropdown-item" href="./fichier/typePret/indexType.php">Type Loan</a>
                            <a class="dropdown-item" href="./fichier/butPret/indexbut.php">Purpose Loan</a>
                            <a class="dropdown-item" href="./fichier/naturePret/indexNature.php">Nature Loan</a>
                        </div>
                    </li>
                    <!--dropdown pour traitement-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Traitment</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../loan/initiation.php">Initiation</a>
                            <a class="dropdown-item" href="../loan/indexConformite.php">Confirmation</a>
                            <a class="dropdown-item" href="../loan/analyse.php">Analyze</a>
                            <a class="dropdown-item" href="../loan/evaluation1.php">1st evaluation</a>
                            <a class="dropdown-item" href="../loan/evaluation2.php">2nd evaluation</a>
                            <a class="dropdown-item" href="../loan/evaluation3.php">3rd evaluation</a>
                            <a class="dropdown-item" href="../loan/risque.php">Risk</a>
                            <a class="dropdown-item" href="../loan/manager.php">Manager</a>
                            <a class="dropdown-item" href="../loan/comitee.php">Credit commitee</a>
                            <a class="dropdown-item" href="../loan/creditAdmin.php">Credit administration</a>
                        </div>
                    </li>
                    <!--autres liens-->
                    <li class="nav-item"><a href="./consultation/indexConsultation.php" class="nav-link">Consultation</a></li>
                    <li class="nav-item"><a href="./analyse/indexAnalyse.php" class="nav-link">Analyzies</a></li>
                    <li class="nav-item"><a href="./outils/indexOutils.php" class="nav-link">Tools</a></li>
                    <li class="nav-item"><a href="./administration/indexUser.php" class="nav-link">Administration</a></li>
                    <li class="nav-item"><a href="../deconnexion.php" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
    <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
    </svg>Log Out </a></li>
                </div>
            </div>
        </nav>
    </header>
    <!--mon main-->
    <main class="container">
        <div class="img-fluid">
            <svg class="img-fluid" width="800" height="500" viewBox="0 0 905 587" fill="none" xmlns="http://www.w3.org/2000/svg">
<g id="undraw_Online_payments_re_y8f2 1" clip-path="url(#clip0)">
                <path id="Vector" d="M28.6622 450.064C33.144 404.317 60.2324 358.652 103.333 342.679C87.4066 390.06 88.7528 441.548 107.133 488.032C114.287 505.934 124.108 525.1 118.297 543.481C114.682 554.918 105.34 563.84 94.7874 569.542C84.2336 575.244 72.4317 578.138 60.7769 580.976L58.5199 582.944C38.818 541.415 24.1803 495.811 28.6622 450.064Z" fill="#F0F0F0"/>
                <path id="Vector_2" d="M103.787 343.53C79.4519 372.253 64.1353 408.937 61.4573 446.545C60.8783 454.675 60.9986 462.974 62.9798 470.921C64.9705 478.653 68.9954 485.711 74.6362 491.361C79.79 496.735 85.684 501.636 89.4416 508.169C93.4023 515.055 93.7544 522.988 91.3611 530.475C88.4327 539.635 82.3875 547.197 76.2188 554.386C69.3697 562.369 62.1291 570.552 59.4008 580.969C59.0702 582.231 57.1311 581.644 57.4612 580.384C62.2079 562.26 79.4031 551.587 87.3081 535.169C90.9967 527.507 92.3988 518.688 88.5479 510.803C85.1805 503.908 79.1069 498.849 73.8416 493.453C68.313 487.787 64.0239 481.524 61.6995 473.891C59.3217 466.084 58.8768 457.773 59.2453 449.664C60.2183 431.28 64.0757 413.164 70.6762 395.978C78.1005 376.323 88.8325 358.082 102.408 342.046C103.248 341.054 104.622 342.544 103.787 343.53L103.787 343.53Z" fill="white"/>
                <path id="Vector_3" d="M61.6827 434.275C55.3852 432.918 49.7747 429.368 45.8533 424.257C41.9319 419.146 39.9549 412.808 40.2754 406.374C40.2909 406.111 40.4075 405.865 40.6008 405.687C40.7941 405.51 41.049 405.414 41.3116 405.42C41.5743 405.426 41.8243 405.534 42.0089 405.721C42.1935 405.908 42.2983 406.159 42.3012 406.422C41.9917 412.413 43.8338 418.317 47.4952 423.069C51.1565 427.82 56.3959 431.107 62.2676 432.335C63.5433 432.603 62.9511 434.541 61.6827 434.275Z" fill="white"/>
                <path id="Vector_4" d="M71.6642 488.981C82.7909 481.937 90.854 470.959 94.2459 458.234C94.5809 456.973 96.5202 457.56 96.1855 458.819C92.6312 472.054 84.217 483.461 72.6222 490.766C71.5165 491.461 70.5645 489.672 71.6642 488.981Z" fill="white"/>
                <path id="Vector_5" d="M80.0293 378.192C82.3567 379.225 84.904 379.663 87.4426 379.468C89.9811 379.272 92.4314 378.45 94.5735 377.073C95.6697 376.364 96.6206 378.154 95.5315 378.858C93.1578 380.368 90.4506 381.273 87.6463 381.495C84.8421 381.717 82.0261 381.249 79.4445 380.132C79.1923 380.047 78.9819 379.869 78.8561 379.635C78.7303 379.4 78.6984 379.127 78.767 378.87C78.8458 378.613 79.0225 378.398 79.2589 378.271C79.4952 378.145 79.7721 378.116 80.0293 378.192H80.0293Z" fill="white"/>
                <path id="Vector_6" d="M238.013 420.668C237.342 421.131 236.67 421.593 235.997 422.072C226.996 428.333 218.518 435.316 210.647 442.95C210.029 443.53 209.411 444.128 208.812 444.725C190.045 463.32 174.894 485.237 164.128 509.363C159.853 518.967 156.315 528.883 153.544 539.023C149.719 553.029 146.685 568.518 138.692 580.101C137.871 581.319 136.976 582.484 136.012 583.592L61.0957 585.545C60.9233 585.464 60.7504 585.4 60.5771 585.319L57.5895 585.534C57.6958 585.001 57.8176 584.45 57.924 583.917C57.9844 583.608 58.0615 583.298 58.1219 582.988C58.1675 582.782 58.2139 582.575 58.2432 582.387C58.2581 582.318 58.2738 582.249 58.2892 582.197C58.3185 582.008 58.3658 581.836 58.3956 581.664C59.0677 578.585 59.7628 575.505 60.4806 572.425C60.4801 572.408 60.4801 572.408 60.4964 572.39C66.0257 548.934 73.5618 525.732 84.3799 504.412C84.7056 503.771 85.03 503.113 85.3899 502.47C90.3195 492.887 96.0241 483.724 102.447 475.07C105.979 470.343 109.748 465.798 113.74 461.452C124.075 450.242 136.109 440.728 149.401 433.258C175.901 418.371 206.867 412.125 235.808 420.042C236.548 420.245 237.273 420.448 238.013 420.668Z" fill="#F0F0F0"/>
                <path id="Vector_7" d="M237.87 421.624C201.146 429.906 166.83 449.974 142.05 478.389C136.692 484.533 131.792 491.231 128.589 498.769C125.523 506.141 124.488 514.2 125.59 522.108C126.469 529.501 128.225 536.963 127.292 544.441C126.308 552.324 121.813 558.87 115.394 563.407C107.541 568.958 98.1616 571.356 88.9077 573.383C78.633 575.632 67.9252 577.807 59.475 584.482C58.4511 585.29 57.2561 583.654 58.2784 582.847C72.9803 571.234 93.1354 573.065 109.332 564.715C116.89 560.818 123.319 554.621 124.992 546.006C126.455 538.473 124.651 530.778 123.696 523.299C122.693 515.446 123.039 507.863 125.778 500.37C128.58 492.705 133.229 485.801 138.406 479.548C150.251 465.455 164.238 453.313 179.855 443.565C197.617 432.342 217.168 424.239 237.662 419.608C238.93 419.322 239.13 421.339 237.87 421.624H237.87Z" fill="white"/>
                <path id="Vector_8" d="M149.617 468.728C145.405 463.854 143.063 457.641 143.009 451.199C142.956 444.758 145.193 438.507 149.323 433.562C150.162 432.565 151.751 433.822 150.911 434.821C147.057 439.417 144.973 445.241 145.036 451.239C145.098 457.238 147.303 463.016 151.252 467.532C152.109 468.514 150.469 469.705 149.617 468.728Z" fill="white"/>
                <path id="Vector_9" d="M124.65 518.417C137.775 519.493 150.822 515.582 161.192 507.464C162.218 506.659 163.414 508.295 162.388 509.099C151.582 517.526 137.996 521.568 124.34 520.419C123.039 520.309 123.356 518.308 124.65 518.417H124.65Z" fill="white"/>
                <path id="Vector_10" d="M198.031 434.996C199.268 437.221 201.038 439.105 203.182 440.477C205.327 441.85 207.779 442.668 210.318 442.859C211.62 442.953 211.302 444.954 210.008 444.861C207.204 444.637 204.497 443.73 202.124 442.219C199.752 440.708 197.785 438.639 196.397 436.192C196.246 435.973 196.185 435.704 196.226 435.441C196.267 435.178 196.406 434.941 196.616 434.777C196.833 434.619 197.103 434.554 197.368 434.595C197.634 434.636 197.872 434.78 198.031 434.996Z" fill="white"/>
                <path id="Vector_11" d="M677.703 40.1378C676.585 36.835 662.558 25.6079 671.153 23.7209L678.202 33.1195L710.608 0.713501L713.868 3.97279L677.703 40.1378Z" fill="#001CCE"/>
                <path id="Vector_12" d="M677.703 150.332C676.585 147.029 662.558 135.802 671.153 133.915L678.202 143.313L710.608 110.907L713.868 114.167L677.703 150.332Z" fill="#001CCE"/>
                <path id="Vector_13" d="M677.703 262.1C676.585 258.797 662.558 247.57 671.153 245.683L678.202 255.082L710.608 222.676L713.868 225.935L677.703 262.1Z" fill="#001CCE"/>
                <path id="Vector_14" d="M647.862 171.738C653.385 171.738 657.862 167.261 657.862 161.738C657.862 156.215 653.385 151.738 647.862 151.738C642.339 151.738 637.862 156.215 637.862 161.738C637.862 167.261 642.339 171.738 647.862 171.738Z" fill="#3F3D56"/>
                <path id="Vector_15" d="M647.862 62.7383C653.385 62.7383 657.862 58.2611 657.862 52.7383C657.862 47.2154 653.385 42.7383 647.862 42.7383C642.339 42.7383 637.862 47.2154 637.862 52.7383C637.862 58.2611 642.339 62.7383 647.862 62.7383Z" fill="#3F3D56"/>
                <path id="check1" d="M904.362 29.7382H743.362V31.7382H904.362V29.7382Z" fill="#3F3D56"/>
                <path id="Vector_16" d="M652.862 287.932C658.385 287.932 662.862 283.455 662.862 277.932C662.862 272.409 658.385 267.932 652.862 267.932C647.339 267.932 642.862 272.409 642.862 277.932C642.862 283.455 647.339 287.932 652.862 287.932Z" fill="#3F3D56"/>
                <path id="check2" d="M904.362 139.932H743.362V141.932H904.362V139.932Z" fill="#3F3D56"/>
                <path id="check3" d="M904.362 251.7H743.362V253.7H904.362V251.7Z" fill="#3F3D56"/>
                <path id="Vector_17" d="M702.96 277H652.96V226H686.96V228H654.96V275H700.96V252H702.96V277Z" fill="#3F3D56"/>
                <path id="Vector_18" d="M702.96 165H652.96V114H686.96V116H654.96V163H700.96V140H702.96V165Z" fill="#3F3D56"/>
                <path id="Vector_19" d="M702.96 51H652.96V0H686.96V2H654.96V49H700.96V26H702.96V51Z" fill="#3F3D56"/>
                <path id="Vector_20" d="M376.505 181.772C376.505 181.772 363.142 238.193 379.474 238.193C395.807 238.193 434.411 174.348 434.411 174.348L421.048 158.015L397.063 191.315L395.807 174.348L376.505 181.772Z" fill="#A0616A"/>
                <path id="Vector_21" d="M430.85 176.801C438.03 176.801 443.85 170.98 443.85 163.801C443.85 156.621 438.03 150.801 430.85 150.801C423.67 150.801 417.85 156.621 417.85 163.801C417.85 170.98 423.67 176.801 430.85 176.801Z" fill="#A0616A"/>
                <path id="Vector_22" d="M365.175 566.048L382.478 566.047L390.711 499.301L365.171 499.302L365.175 566.048Z" fill="#A0616A"/>
                <path id="Vector_23" d="M364.565 584.1L417.778 584.098V583.425C417.778 577.932 415.595 572.664 411.711 568.78C407.827 564.895 402.559 562.713 397.066 562.713H397.065L387.345 555.339L369.209 562.714L364.564 562.714L364.565 584.1Z" fill="#2F2E41"/>
                <path id="Vector_24" d="M179.038 544.459L194.521 552.185L231.693 496.14L208.841 484.736L179.038 544.459Z" fill="#A0616A"/>
                <path id="Vector_25" d="M170.431 560.338L218.044 584.1L218.345 583.497C220.797 578.582 221.197 572.894 219.457 567.685C217.716 562.475 213.977 558.17 209.062 555.716L209.061 555.716L203.657 544.777L184.137 543.278L179.98 541.203L170.431 560.338Z" fill="#2F2E41"/>
                <path id="Vector_26" d="M569.85 584.165H0V586.406H569.85V584.165Z" fill="#CCCCCC"/>
                <path id="Vector_27" d="M253.298 284.128C253.298 284.128 246.383 367.276 244.898 385.094C243.88 396.262 241.384 407.247 237.474 417.759C237.474 417.759 234.505 423.698 234.505 429.637L200.85 490.801C200.85 490.801 190.566 498.36 192.05 504.299C193.535 510.238 185.85 513.801 185.85 513.801L221.292 520.631C221.292 520.631 219.807 516.177 224.261 514.692C228.715 513.208 232.261 500.329 232.261 500.329L282.017 419.243L317.652 345.005C317.652 345.005 338.439 411.82 342.893 419.243C342.893 419.243 359.225 502.39 362.195 509.814C365.164 517.238 366.649 517.238 365.164 520.208C363.68 523.177 363.68 526.147 365.164 527.631C366.649 529.116 394.86 527.631 394.86 527.631L387.436 422.213L374.073 296.007L305.774 275.221L253.298 284.128Z" fill="#2F2E41"/>
                <path id="Vector_28" d="M320.167 85.6318C337.387 85.6318 351.347 71.6719 351.347 54.4516C351.347 37.2313 337.387 23.2715 320.167 23.2715C302.947 23.2715 288.987 37.2313 288.987 54.4516C288.987 71.6719 302.947 85.6318 320.167 85.6318Z" fill="#A0616A"/>
                <path id="Vector_29" d="M377.042 131.198L339.924 108.709C339.924 108.709 338.896 94.7447 328.32 94.0876C323.01 93.7577 315.042 93.2533 303.085 92.4824C300.558 92.3195 298.853 106.145 295.957 105.957L256.776 116.35L262.715 217.315C262.715 217.315 253.807 257.403 256.776 264.827C259.746 272.251 249.352 275.221 252.322 276.705C255.291 278.19 252.322 288.584 252.322 288.584C252.322 288.584 310.228 318.279 374.073 296.007L368.134 276.705C368.942 274.182 369.094 271.495 368.574 268.897C368.054 266.299 366.881 263.876 365.164 261.858C365.164 261.858 371.103 252.949 363.679 245.525C363.679 245.525 366.649 232.162 359.225 226.223L357.74 205.436L362.195 195.043L377.042 131.198Z" fill="#E6E6E6"/>
                <path id="Vector_30" d="M293.111 72.264L292.239 70.2396C292.127 69.9779 281.1 43.9105 290.874 27.8314C295.398 20.3875 303.625 16.1849 315.325 15.3411C333.633 14.0174 346.162 18.3601 352.576 28.2396C353.652 29.9139 354.256 31.8472 354.326 33.8359C354.396 35.8247 353.929 37.7956 352.974 39.5414C352.019 41.2872 350.611 42.7433 348.898 43.7568C347.185 44.7702 345.231 45.3035 343.241 45.3006H342.995L339.632 40.9329L339.436 41.3577C338.218 43.9925 335.421 45.4349 332.145 45.1189C331.588 45.0789 331.094 45.5599 330.698 46.5892C330.565 47.0394 330.312 47.4455 329.968 47.7646C329.624 48.0838 329.2 48.3044 328.74 48.4032C326.32 48.8744 322.87 45.8255 321.325 44.306C321.266 44.6557 321.132 44.9886 320.933 45.2821C320.733 45.5756 320.473 45.8228 320.17 46.0072C318.543 46.9462 316.01 45.7196 315.283 45.3289C309.491 46.5594 305.742 46.2303 304.137 44.3519C303.048 52.0555 300.711 65.9217 297.909 66.6903C297.616 66.7576 297.309 66.729 297.033 66.6086C296.758 66.4883 296.529 66.2825 296.379 66.0218C295.704 65.1458 295.101 64.7093 294.725 64.8319C293.813 65.1219 293.275 68.1239 293.198 70.0614L293.111 72.264Z" fill="#2F2E41"/>
                <path id="Vector_31" d="M360.71 132.683L375.521 130.276C386.191 140.528 393.459 153.805 396.344 168.317C400.799 192.074 402.284 196.528 402.284 196.528L366.649 205.436L347.347 168.317L360.71 132.683Z" fill="#E6E6E6"/>
                <path id="Vector_32" d="M294.987 163.583L285.834 279.617L519.419 298.043L528.572 182.008L294.987 163.583Z" fill="white"/>
                <path id="Vector_33" d="M319.943 172.572C314.226 168.49 306.969 168.195 304.196 168.254C305.042 170.894 307.671 177.665 313.387 181.749C319.117 185.842 326.366 186.128 329.134 186.071C328.289 183.431 325.66 176.657 319.943 172.572Z" fill="#001CCE"/>
                <path id="Vector_34" d="M342.493 246.407L304.986 243.449C303.878 243.361 302.764 243.493 301.706 243.836C300.649 244.18 299.669 244.728 298.824 245.45C297.979 246.171 297.284 247.053 296.779 248.043C296.274 249.034 295.969 250.114 295.882 251.222C295.794 252.33 295.926 253.445 296.269 254.502C296.613 255.559 297.161 256.539 297.883 257.384C298.604 258.23 299.486 258.925 300.476 259.43C301.467 259.934 302.547 260.239 303.655 260.327L341.162 263.285C343.4 263.462 345.617 262.742 347.324 261.284C349.032 259.827 350.09 257.75 350.267 255.512C350.443 253.274 349.724 251.057 348.266 249.35C346.808 247.642 344.732 246.584 342.493 246.407Z" fill="#001CCE"/>
                <path id="Vector_35" d="M519.364 170.73L309.074 154.14C306.628 153.947 304.168 154.238 301.834 154.996C299.501 155.754 297.34 156.965 295.474 158.558C293.608 160.152 292.075 162.097 290.961 164.283C289.847 166.469 289.175 168.853 288.982 171.299L280.895 273.75C280.506 278.691 282.095 283.584 285.313 287.354C288.532 291.123 293.115 293.46 298.056 293.851L508.346 310.441C510.792 310.634 513.252 310.343 515.585 309.585C517.919 308.827 520.08 307.616 521.946 306.023C523.812 304.43 525.345 302.484 526.459 300.298C527.573 298.112 528.245 295.728 528.438 293.282L536.123 195.907L536.278 193.917L536.523 190.822C536.715 188.376 536.424 185.916 535.666 183.582C534.908 181.249 533.698 179.088 532.105 177.222C530.511 175.356 528.566 173.823 526.38 172.709C524.194 171.595 521.81 170.922 519.364 170.73ZM513.154 259.868L511.822 276.746C511.578 279.727 510.164 282.491 507.889 284.432C505.614 286.374 502.662 287.335 499.68 287.107L471.547 284.89C468.565 284.647 465.802 283.233 463.861 280.958C461.919 278.682 460.957 275.731 461.186 272.749L462.518 255.87C462.763 252.889 464.177 250.127 466.452 248.185C468.727 246.244 471.678 245.282 474.66 245.509L502.784 247.729C505.764 247.973 508.528 249.387 510.471 251.661C512.413 253.935 513.378 256.885 513.154 259.868ZM294.02 251.067C294.239 248.335 295.531 245.802 297.615 244.023C299.699 242.244 302.403 241.363 305.135 241.576L342.64 244.536C343.995 244.641 345.316 245.011 346.528 245.627C347.739 246.242 348.818 247.09 349.701 248.123C350.585 249.155 351.257 250.351 351.678 251.643C352.099 252.935 352.261 254.298 352.155 255.652C352.05 257.007 351.678 258.328 351.062 259.539C350.445 260.75 349.596 261.828 348.563 262.71C347.53 263.593 346.333 264.264 345.041 264.684C343.749 265.104 342.386 265.265 341.032 265.158L341.012 265.163L303.507 262.203C302.152 262.096 300.832 261.722 299.622 261.105C298.412 260.487 297.335 259.636 296.454 258.602C295.573 257.568 294.904 256.37 294.487 255.077C294.069 253.784 293.911 252.421 294.02 251.067ZM302.05 167.585L301.793 166.536L302.872 166.437C303.294 166.391 313.271 165.496 321.037 171.043C328.803 176.591 331.185 186.324 331.288 186.731L331.535 187.783L330.459 187.891C328.931 188.005 327.396 187.995 325.87 187.861C321.014 187.577 316.325 185.993 312.291 183.275C304.525 177.728 302.143 167.994 302.05 167.585Z" fill="#001CCE"/>
                <path id="Vector_36" d="M481.603 271.062L469.414 270.1C468.544 270.033 467.683 270.314 467.021 270.881C466.358 271.448 465.947 272.254 465.879 273.124C465.81 273.993 466.089 274.854 466.655 275.518C467.221 276.181 468.027 276.594 468.896 276.664L481.086 277.625C481.955 277.692 482.816 277.412 483.478 276.845C484.141 276.278 484.552 275.471 484.621 274.602C484.689 273.733 484.41 272.871 483.844 272.208C483.279 271.544 482.473 271.132 481.603 271.062Z" fill="#001CCE"/>
                <path id="Vector_37" d="M504.108 272.837L491.918 271.875C491.049 271.809 490.189 272.09 489.526 272.657C488.864 273.223 488.454 274.03 488.385 274.899C488.317 275.768 488.595 276.629 489.161 277.292C489.726 277.956 490.531 278.368 491.4 278.439L503.59 279.4C504.459 279.467 505.319 279.186 505.981 278.619C506.643 278.052 507.054 277.246 507.122 276.377C507.191 275.508 506.912 274.647 506.347 273.984C505.782 273.32 504.976 272.907 504.108 272.837Z" fill="#001CCE"/>
                <path id="Vector_38" d="M482.269 262.623L470.079 261.661C469.21 261.595 468.35 261.876 467.688 262.442C467.026 263.009 466.615 263.816 466.547 264.685C466.478 265.554 466.757 266.414 467.322 267.078C467.887 267.742 468.693 268.154 469.561 268.225L481.751 269.186C482.621 269.253 483.481 268.973 484.144 268.406C484.807 267.839 485.218 267.032 485.286 266.163C485.355 265.293 485.076 264.432 484.51 263.769C483.944 263.105 483.138 262.693 482.269 262.623Z" fill="#001CCE"/>
                <path id="Vector_39" d="M504.773 264.398L492.583 263.436C491.714 263.369 490.853 263.65 490.191 264.217C489.528 264.784 489.117 265.59 489.049 266.46C488.98 267.329 489.259 268.19 489.825 268.854C490.39 269.518 491.196 269.93 492.066 270L504.255 270.961C505.125 271.029 505.986 270.748 506.648 270.181C507.311 269.614 507.722 268.807 507.79 267.938C507.859 267.069 507.58 266.207 507.014 265.544C506.448 264.88 505.643 264.468 504.773 264.398Z" fill="#001CCE"/>
                <path id="Vector_40" d="M482.935 254.183L470.745 253.222C469.875 253.155 469.015 253.435 468.352 254.002C467.689 254.569 467.278 255.376 467.21 256.245C467.141 257.115 467.421 257.976 467.986 258.64C468.552 259.303 469.358 259.715 470.227 259.786L482.417 260.747C483.286 260.814 484.146 260.532 484.808 259.966C485.471 259.399 485.881 258.592 485.95 257.723C486.018 256.854 485.739 255.994 485.174 255.33C484.609 254.666 483.804 254.254 482.935 254.183Z" fill="#001CCE"/>
                <path id="Vector_41" d="M505.439 255.959L493.249 254.997C492.38 254.931 491.52 255.212 490.858 255.778C490.195 256.345 489.785 257.152 489.716 258.021C489.648 258.89 489.927 259.75 490.492 260.414C491.057 261.078 491.862 261.49 492.731 261.561L504.921 262.522C505.79 262.589 506.65 262.308 507.313 261.741C507.975 261.174 508.385 260.368 508.454 259.499C508.522 258.63 508.243 257.769 507.678 257.105C507.113 256.442 506.308 256.029 505.439 255.959Z" fill="#001CCE"/>
                <path id="Vector_42" d="M285.856 203.625L285.699 205.62L532.552 225.011L532.709 223.017L285.856 203.625Z" fill="white"/>
                <path id="Vector_43" d="M536.278 193.917L536.123 195.907L527.532 195.233L435.999 188.043L436.164 186.051L527.687 193.243L536.278 193.917Z" fill="#3F3D56"/>
                <path id="Vector_44" d="M234.505 172.772C234.505 172.772 221.142 229.193 237.474 229.193C253.807 229.193 292.411 165.348 292.411 165.348L279.048 149.015L255.063 182.315L253.807 165.348L234.505 172.772Z" fill="#A0616A"/>
                <path id="Vector_45" d="M288.85 167.801C296.03 167.801 301.85 161.98 301.85 154.801C301.85 147.621 296.03 141.801 288.85 141.801C281.67 141.801 275.85 147.621 275.85 154.801C275.85 161.98 281.67 167.801 288.85 167.801Z" fill="#A0616A"/>
                <path id="Vector_46" d="M267.592 125.259L258.684 116.35C258.684 116.35 240.867 126.744 239.382 137.137C237.897 147.531 230.473 180.196 230.473 180.196L257.941 182.423L266.85 169.06L267.592 125.259Z" fill="#E6E6E6"/>
                </g>
                <defs>
                <clipPath id="clip0">
                <rect width="904.362" height="586.406" fill="white"/>
                </clipPath>
                </defs>
            </svg>

        </div>
    </main>

</body>
</html>