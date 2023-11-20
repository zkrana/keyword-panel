<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Qeeword Admin Login </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="admin/css/login.css">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.svg">
    <style>
        .error-message {
          color: red;
          margin: 15px 0;
          text-align: center;
        }
    </style>
</head>
<body>
    
    <div class="login-wrapper">
        <a class="logo logo-desc">
         <svg width="409" height="78" viewBox="0 0 409 78" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M396.621 15.3717V34.4287H396.331C395.662 33.5538 394.918 32.7401 394.107 31.9969C393.122 31.0945 392.035 30.311 390.869 29.662C387.778 27.9493 384.296 27.0775 380.768 27.1327C377.716 27.0975 374.691 27.712 371.892 28.9359C369.093 30.1598 366.583 31.9654 364.526 34.2342C362.492 36.5002 360.916 39.1433 359.887 42.0158C358.773 45.1018 358.216 48.3632 358.243 51.6463C358.219 54.9407 358.759 58.2148 359.838 61.3252C360.832 64.2223 362.375 66.8979 364.382 69.2038C366.376 71.4621 368.81 73.2828 371.534 74.5525C374.522 75.9206 377.775 76.6019 381.057 76.5469C384.258 76.5663 387.419 75.8333 390.289 74.4061C393.089 73.0424 395.426 70.8768 397.007 68.1811H397.2V75.187H408.221V15.2814C406.56 16.5637 404.529 17.2663 402.436 17.2826C400.342 17.2989 398.301 16.628 396.62 15.3717H396.621ZM393.737 57.239C393.138 58.9987 392.219 60.6314 391.029 62.0542C389.836 63.4802 388.374 64.6536 386.728 65.5062C384.916 66.3791 382.931 66.8282 380.922 66.8199C378.913 66.8116 376.932 66.3462 375.127 65.4584C373.51 64.6012 372.092 63.4073 370.97 61.956C369.858 60.501 369.022 58.8526 368.504 57.093C367.964 55.3274 367.687 53.4908 367.683 51.6433C367.685 49.8124 367.962 47.9923 368.504 46.2446C369.03 44.503 369.866 42.8715 370.97 41.4294C372.086 39.9852 373.506 38.8065 375.127 37.977C376.958 37.0654 378.982 36.6148 381.025 36.6639C383.01 36.6301 384.971 37.0983 386.729 38.0256C388.37 38.9076 389.83 40.0958 391.03 41.5269C392.228 42.9632 393.146 44.6132 393.738 46.391C394.34 48.1434 394.65 49.9837 394.657 51.8377C394.653 53.6773 394.342 55.5031 393.737 57.239Z" fill="#222240"/>
            <path d="M402.366 13.399C403.537 13.3991 404.682 13.0498 405.656 12.3953C406.63 11.7408 407.389 10.8105 407.837 9.72195C408.285 8.63341 408.403 7.43556 408.174 6.2799C407.946 5.12423 407.382 4.06265 406.554 3.2294C405.726 2.39615 404.671 1.82866 403.523 1.59869C402.374 1.36872 401.184 1.4866 400.102 1.93742C399.02 2.38825 398.095 3.15176 397.445 4.13142C396.794 5.11108 396.447 6.26288 396.447 7.44116C396.447 9.02107 397.07 10.5363 398.18 11.6536C399.291 12.7708 400.796 13.3987 402.366 13.399Z" fill="#222240"/>
            <path d="M343.249 27.0137C341.887 27.4469 340.602 28.0964 339.443 28.9375C337.025 30.7028 335.095 33.0607 333.837 35.7874H333.637V27.7289H322.122V76.0836H334.136V50.1942C334.178 49.004 334.346 47.8217 334.637 46.6672C335.001 45.1185 335.646 43.6507 336.539 42.3372C337.555 40.8498 338.889 39.6102 340.443 38.7094C341.381 38.1627 342.402 37.7738 343.464 37.5579C342.453 35.9962 341.897 34.1808 341.858 32.3173C341.82 30.4538 342.301 28.6168 343.248 27.0144L343.249 27.0137Z" fill="#222240"/>
            <path d="M351.987 25.9144C350.774 25.9145 349.589 26.2763 348.581 26.9543C347.572 27.6322 346.787 28.5957 346.323 29.723C345.859 30.8503 345.737 32.0907 345.974 33.2874C346.21 34.4841 346.794 35.5833 347.652 36.4461C348.509 37.3089 349.601 37.8966 350.791 38.1347C351.98 38.3728 353.213 38.2507 354.333 37.7838C355.454 37.317 356.411 36.5263 357.085 35.5119C357.759 34.4974 358.118 33.3047 358.119 32.0846C358.119 31.2743 357.96 30.472 357.652 29.7234C357.344 28.9748 356.892 28.2946 356.323 27.7216C355.753 27.1487 355.077 26.6942 354.333 26.3841C353.589 26.074 352.792 25.9144 351.987 25.9144Z" fill="#222240"/>
            <path d="M265.225 26.6706C265.244 26.6975 265.268 26.7207 265.287 26.7475L265.313 26.6706H265.225Z" fill="#222240"/>
            <path d="M248.78 39.2753L242.034 62.1669L231.11 26.7087H217.992L207.271 62.1669L197.015 26.6706H183.683L200.81 76.2005H213.321L224.396 41.5291H224.601L235.778 76.1982C235.779 76.1989 235.779 76.1995 235.78 76.1999C235.781 76.2003 235.782 76.2005 235.783 76.2005H248.288L248.291 76.1982L259.768 42.8057C257.798 43.4263 255.686 43.4203 253.719 42.7884C251.753 42.1565 250.028 40.9299 248.78 39.2753Z" fill="#222240"/>
            <path d="M256.883 26.5071C255.641 26.5072 254.426 26.8779 253.394 27.5722C252.361 28.2666 251.556 29.2535 251.081 30.4081C250.606 31.5628 250.481 32.8333 250.724 34.059C250.966 35.2848 251.564 36.4107 252.442 37.2944C253.32 38.1782 254.439 38.78 255.657 39.0239C256.876 39.2678 258.138 39.1427 259.286 38.6645C260.433 38.1864 261.414 37.3766 262.104 36.3375C262.795 35.2984 263.163 34.0768 263.163 32.827C263.163 31.1509 262.501 29.5435 261.324 28.3583C260.146 27.1731 258.548 26.5072 256.883 26.5071Z" fill="#222240"/>
            <path d="M291.351 45.2409C290.157 45.241 288.99 45.5973 287.998 46.2646C287.005 46.932 286.232 47.8806 285.775 48.9904C285.318 50.1001 285.198 51.3213 285.431 52.4994C285.664 53.6775 286.239 54.7597 287.083 55.609C287.927 56.4584 289.003 57.0369 290.174 57.2712C291.345 57.5056 292.558 57.3853 293.661 56.9257C294.764 56.466 295.707 55.6876 296.37 54.6889C297.033 53.6902 297.387 52.516 297.387 51.3148C297.388 50.5171 297.231 49.7273 296.928 48.9903C296.625 48.2533 296.18 47.5837 295.62 47.0197C295.059 46.4557 294.394 46.0083 293.661 45.7031C292.929 45.3979 292.144 45.2408 291.351 45.2409Z" fill="#222240"/>
            <path d="M291.351 26.1245C286.4 26.1245 281.559 27.6019 277.442 30.3699C273.326 33.1378 270.117 37.072 268.222 41.6749C266.327 46.2778 265.831 51.3427 266.797 56.2292C267.763 61.1156 270.148 65.6041 273.649 69.127C277.15 72.6499 281.611 75.0491 286.467 76.021C291.323 76.993 296.357 76.4942 300.931 74.5876C305.506 72.681 309.416 69.4523 312.167 65.3098C314.918 61.1672 316.386 56.297 316.386 51.3148C316.386 48.0068 315.738 44.7311 314.48 41.6748C313.222 38.6186 311.378 35.8416 309.053 33.5025C306.729 31.1633 303.969 29.3079 300.931 28.0419C297.894 26.776 294.639 26.1245 291.351 26.1245ZM291.351 66.0366C288.457 66.0366 285.629 65.1731 283.223 63.5554C280.817 61.9377 278.941 59.6384 277.834 56.9483C276.727 54.2583 276.437 51.2982 277.002 48.4425C277.566 45.5867 278.96 42.9636 281.006 40.9048C283.052 38.8459 285.659 37.4438 288.497 36.8758C291.335 36.3078 294.277 36.5994 296.951 37.7136C299.624 38.8279 301.909 40.7148 303.517 43.1358C305.124 45.5568 305.982 48.4031 305.982 51.3148C305.982 53.2481 305.604 55.1625 304.869 56.9486C304.133 58.7347 303.055 60.3576 301.697 61.7246C300.338 63.0916 298.725 64.176 296.95 64.9158C295.175 65.6556 293.272 66.0363 291.351 66.0363V66.0366Z" fill="#222240"/>
            <path d="M111.803 66.0982C110.141 66.5786 108.418 66.815 106.688 66.8C105.004 66.8047 103.333 66.5021 101.757 65.9067C100.22 65.3363 98.7867 64.5149 97.5152 63.4756C96.2786 62.4663 95.2557 61.2178 94.5071 59.8037C93.7389 58.3439 93.2853 56.7375 93.176 55.0893H129.176C129.025 48.4481 128.698 43.8591 127.548 40.6497C126.529 37.6628 124.9 34.9242 122.764 32.6105C120.736 30.4686 118.26 28.8078 115.515 27.7487C112.602 26.6348 109.508 26.0791 106.392 26.1104C103.002 26.0806 99.6373 26.7039 96.4799 27.9465C93.4893 29.1068 90.7707 30.8789 88.4958 33.1508C86.221 35.4228 84.4395 38.145 83.2641 41.1454C81.9465 44.4747 81.2928 48.0324 81.3403 51.6157C81.2801 55.1998 81.9342 58.7597 83.2641 62.0852C84.4604 65.0382 86.2771 67.696 88.5897 69.8765C90.92 72.0326 93.6523 73.7021 96.6283 74.7884C99.8839 75.9749 103.325 76.5634 106.787 76.526C110.391 76.5738 113.971 75.925 117.332 74.6148C115.737 73.8235 114.382 72.6156 113.41 71.1175C112.437 69.6193 111.882 67.8859 111.803 66.0982ZM97.2685 38.2686C99.7342 36.1188 102.742 35.0438 106.293 35.0435C108.001 35.0052 109.698 35.3266 111.274 35.9871C112.594 36.5457 113.773 37.3918 114.729 38.4645C115.684 39.5371 116.391 40.8096 116.798 42.1902C117.229 43.6051 117.445 45.0775 117.438 46.5574H93.1771C93.2661 44.969 93.6748 43.4153 94.3782 41.9905C95.0817 40.5657 96.0654 39.2995 97.2697 38.2686H97.2685Z" fill="#222240"/>
            <path d="M121.738 59.5716C120.543 59.5715 119.375 59.9279 118.382 60.5957C117.389 61.2634 116.615 62.2126 116.157 63.3231C115.7 64.4337 115.58 65.6557 115.813 66.8346C116.046 68.0136 116.622 69.0966 117.466 69.9466C118.311 70.7966 119.387 71.3755 120.559 71.61C121.731 71.8445 122.945 71.7242 124.049 71.2642C125.153 70.8042 126.096 70.0252 126.76 69.0258C127.423 68.0263 127.778 66.8512 127.778 65.6492C127.778 64.0374 127.141 62.4916 126.009 61.3518C124.876 60.212 123.34 59.5717 121.738 59.5716Z" fill="#DA0000"/>
            <path d="M165.254 66.6537C163.591 67.1341 161.868 67.3704 160.139 67.3554C158.455 67.3601 156.784 67.0575 155.207 66.4622C153.67 65.8917 152.237 65.0703 150.966 64.0311C149.729 63.0219 148.706 61.7733 147.958 60.3592C147.19 58.8993 146.736 57.2929 146.627 55.6448H182.626C182.475 49.0035 182.149 44.4145 180.998 41.2051C179.98 38.2183 178.35 35.4796 176.215 33.1659C174.187 31.0241 171.71 29.3633 168.965 28.3041C166.052 27.1902 162.958 26.6345 159.842 26.6658C156.452 26.6361 153.087 27.2593 149.93 28.5019C146.939 29.6622 144.221 31.4344 141.946 33.7063C139.671 35.9782 137.89 38.7005 136.714 41.7008C135.397 45.0302 134.743 48.5878 134.791 52.1711C134.731 55.7553 135.385 59.3153 136.714 62.641C137.911 65.5939 139.728 68.2516 142.04 70.4319C144.37 72.5883 147.103 74.2579 150.079 75.3438C153.334 76.5303 156.775 77.1188 160.238 77.0814C163.842 77.1292 167.421 76.4804 170.782 75.1702C169.187 74.3789 167.832 73.171 166.86 71.6729C165.888 70.1747 165.333 68.4413 165.254 66.6537ZM150.719 38.824C153.185 36.6742 156.193 35.5992 159.744 35.5989C161.451 35.5604 163.148 35.8815 164.725 36.5418C166.044 37.1005 167.224 37.9466 168.179 39.0192C169.134 40.0919 169.841 41.3643 170.249 42.7449C170.679 44.1598 170.895 45.6322 170.889 47.1121H146.628C146.717 45.5239 147.125 43.9705 147.828 42.5458C148.532 41.1212 149.515 39.855 150.719 38.824Z" fill="#222240"/>
            <path d="M175.188 60.127C173.993 60.127 172.825 60.4834 171.832 61.1513C170.839 61.8191 170.065 62.7683 169.607 63.8788C169.15 64.9893 169.031 66.2114 169.264 67.3903C169.497 68.5692 170.072 69.6522 170.917 70.5021C171.761 71.3521 172.838 71.9309 174.009 72.1654C175.181 72.4 176.395 72.2796 177.499 71.8196C178.603 71.3596 179.546 70.5806 180.21 69.5812C180.874 68.5817 181.228 67.4067 181.228 66.2046C181.228 65.4065 181.072 64.6162 180.768 63.8788C180.464 63.1414 180.02 62.4715 179.459 61.9071C178.898 61.3427 178.232 60.8951 177.499 60.5896C176.766 60.2842 175.981 60.127 175.188 60.127Z" fill="#FF8200"/>
            <path d="M38.2101 31.0611C36.752 31.0612 35.3268 31.4964 34.1145 32.3115C32.9023 33.1267 31.9575 34.2852 31.3996 35.6407C30.8417 36.9961 30.6958 38.4876 30.9803 39.9265C31.2647 41.3654 31.9669 42.6871 32.9978 43.7244C34.0288 44.7618 35.3424 45.4683 36.7724 45.7546C38.2024 46.0408 39.6846 45.894 41.0317 45.3326C42.3788 44.7712 43.5302 43.8206 44.3403 42.6008C45.1504 41.381 45.5829 39.9469 45.5831 38.4798C45.5831 37.5056 45.3924 36.5409 45.0219 35.6407C44.6514 34.7406 44.1083 33.9228 43.4237 33.2339C42.739 32.545 41.9262 31.9985 41.0316 31.6257C40.1371 31.2529 39.1783 31.061 38.2101 31.0611Z" fill="#222240"/>
            <path d="M75.7112 38.4795C75.716 30.5081 73.2134 22.7396 68.5618 16.287C63.9102 9.83441 57.3483 5.02868 49.8162 2.55827C42.284 0.087867 34.168 0.0795337 26.6309 2.53447C19.0937 4.9894 12.5221 9.78164 7.85744 16.2247C3.19276 22.6677 0.674361 30.431 0.663002 38.4024C0.651644 46.3738 3.14791 54.1443 7.7942 60.6008C12.4405 67.0573 18.9984 71.8685 26.5286 74.3451C34.0587 76.8218 42.1746 76.8369 49.7138 74.3882H75.7112V64.0415H65.7403C72.1516 57.0927 75.7135 47.9611 75.7112 38.4795ZM38.2108 63.2222C33.3474 63.2222 28.5932 61.771 24.5494 59.0523C20.5056 56.3335 17.3538 52.4692 15.4927 47.9481C13.6315 43.4269 13.1445 38.452 14.0934 33.6524C15.0422 28.8528 17.3841 24.4441 20.8231 20.9837C24.2621 17.5234 28.6436 15.1669 33.4136 14.2122C38.1836 13.2575 43.1278 13.7475 47.621 15.6202C52.1142 17.4929 55.9547 20.6642 58.6566 24.7332C61.3586 28.8021 62.8008 33.5858 62.8008 38.4795C62.8008 45.0416 60.2101 51.335 55.5986 55.9752C50.9871 60.6154 44.7325 63.2222 38.2108 63.2222Z" fill="#222240"/>
          </svg>
        </a>

        <div class="login">
            <a href="index.php" class="logo logo-mb">
                <svg width="409" height="78" viewBox="0 0 409 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                   <path d="M396.621 15.3717V34.4287H396.331C395.662 33.5538 394.918 32.7401 394.107 31.9969C393.122 31.0945 392.035 30.311 390.869 29.662C387.778 27.9493 384.296 27.0775 380.768 27.1327C377.716 27.0975 374.691 27.712 371.892 28.9359C369.093 30.1598 366.583 31.9654 364.526 34.2342C362.492 36.5002 360.916 39.1433 359.887 42.0158C358.773 45.1018 358.216 48.3632 358.243 51.6463C358.219 54.9407 358.759 58.2148 359.838 61.3252C360.832 64.2223 362.375 66.8979 364.382 69.2038C366.376 71.4621 368.81 73.2828 371.534 74.5525C374.522 75.9206 377.775 76.6019 381.057 76.5469C384.258 76.5663 387.419 75.8333 390.289 74.4061C393.089 73.0424 395.426 70.8768 397.007 68.1811H397.2V75.187H408.221V15.2814C406.56 16.5637 404.529 17.2663 402.436 17.2826C400.342 17.2989 398.301 16.628 396.62 15.3717H396.621ZM393.737 57.239C393.138 58.9987 392.219 60.6314 391.029 62.0542C389.836 63.4802 388.374 64.6536 386.728 65.5062C384.916 66.3791 382.931 66.8282 380.922 66.8199C378.913 66.8116 376.932 66.3462 375.127 65.4584C373.51 64.6012 372.092 63.4073 370.97 61.956C369.858 60.501 369.022 58.8526 368.504 57.093C367.964 55.3274 367.687 53.4908 367.683 51.6433C367.685 49.8124 367.962 47.9923 368.504 46.2446C369.03 44.503 369.866 42.8715 370.97 41.4294C372.086 39.9852 373.506 38.8065 375.127 37.977C376.958 37.0654 378.982 36.6148 381.025 36.6639C383.01 36.6301 384.971 37.0983 386.729 38.0256C388.37 38.9076 389.83 40.0958 391.03 41.5269C392.228 42.9632 393.146 44.6132 393.738 46.391C394.34 48.1434 394.65 49.9837 394.657 51.8377C394.653 53.6773 394.342 55.5031 393.737 57.239Z" fill="#222240"/>
                   <path d="M402.366 13.399C403.537 13.3991 404.682 13.0498 405.656 12.3953C406.63 11.7408 407.389 10.8105 407.837 9.72195C408.285 8.63341 408.403 7.43556 408.174 6.2799C407.946 5.12423 407.382 4.06265 406.554 3.2294C405.726 2.39615 404.671 1.82866 403.523 1.59869C402.374 1.36872 401.184 1.4866 400.102 1.93742C399.02 2.38825 398.095 3.15176 397.445 4.13142C396.794 5.11108 396.447 6.26288 396.447 7.44116C396.447 9.02107 397.07 10.5363 398.18 11.6536C399.291 12.7708 400.796 13.3987 402.366 13.399Z" fill="#222240"/>
                   <path d="M343.249 27.0137C341.887 27.4469 340.602 28.0964 339.443 28.9375C337.025 30.7028 335.095 33.0607 333.837 35.7874H333.637V27.7289H322.122V76.0836H334.136V50.1942C334.178 49.004 334.346 47.8217 334.637 46.6672C335.001 45.1185 335.646 43.6507 336.539 42.3372C337.555 40.8498 338.889 39.6102 340.443 38.7094C341.381 38.1627 342.402 37.7738 343.464 37.5579C342.453 35.9962 341.897 34.1808 341.858 32.3173C341.82 30.4538 342.301 28.6168 343.248 27.0144L343.249 27.0137Z" fill="#222240"/>
                   <path d="M351.987 25.9144C350.774 25.9145 349.589 26.2763 348.581 26.9543C347.572 27.6322 346.787 28.5957 346.323 29.723C345.859 30.8503 345.737 32.0907 345.974 33.2874C346.21 34.4841 346.794 35.5833 347.652 36.4461C348.509 37.3089 349.601 37.8966 350.791 38.1347C351.98 38.3728 353.213 38.2507 354.333 37.7838C355.454 37.317 356.411 36.5263 357.085 35.5119C357.759 34.4974 358.118 33.3047 358.119 32.0846C358.119 31.2743 357.96 30.472 357.652 29.7234C357.344 28.9748 356.892 28.2946 356.323 27.7216C355.753 27.1487 355.077 26.6942 354.333 26.3841C353.589 26.074 352.792 25.9144 351.987 25.9144Z" fill="#222240"/>
                   <path d="M265.225 26.6706C265.244 26.6975 265.268 26.7207 265.287 26.7475L265.313 26.6706H265.225Z" fill="#222240"/>
                   <path d="M248.78 39.2753L242.034 62.1669L231.11 26.7087H217.992L207.271 62.1669L197.015 26.6706H183.683L200.81 76.2005H213.321L224.396 41.5291H224.601L235.778 76.1982C235.779 76.1989 235.779 76.1995 235.78 76.1999C235.781 76.2003 235.782 76.2005 235.783 76.2005H248.288L248.291 76.1982L259.768 42.8057C257.798 43.4263 255.686 43.4203 253.719 42.7884C251.753 42.1565 250.028 40.9299 248.78 39.2753Z" fill="#222240"/>
                   <path d="M256.883 26.5071C255.641 26.5072 254.426 26.8779 253.394 27.5722C252.361 28.2666 251.556 29.2535 251.081 30.4081C250.606 31.5628 250.481 32.8333 250.724 34.059C250.966 35.2848 251.564 36.4107 252.442 37.2944C253.32 38.1782 254.439 38.78 255.657 39.0239C256.876 39.2678 258.138 39.1427 259.286 38.6645C260.433 38.1864 261.414 37.3766 262.104 36.3375C262.795 35.2984 263.163 34.0768 263.163 32.827C263.163 31.1509 262.501 29.5435 261.324 28.3583C260.146 27.1731 258.548 26.5072 256.883 26.5071Z" fill="#222240"/>
                   <path d="M291.351 45.2409C290.157 45.241 288.99 45.5973 287.998 46.2646C287.005 46.932 286.232 47.8806 285.775 48.9904C285.318 50.1001 285.198 51.3213 285.431 52.4994C285.664 53.6775 286.239 54.7597 287.083 55.609C287.927 56.4584 289.003 57.0369 290.174 57.2712C291.345 57.5056 292.558 57.3853 293.661 56.9257C294.764 56.466 295.707 55.6876 296.37 54.6889C297.033 53.6902 297.387 52.516 297.387 51.3148C297.388 50.5171 297.231 49.7273 296.928 48.9903C296.625 48.2533 296.18 47.5837 295.62 47.0197C295.059 46.4557 294.394 46.0083 293.661 45.7031C292.929 45.3979 292.144 45.2408 291.351 45.2409Z" fill="#222240"/>
                   <path d="M291.351 26.1245C286.4 26.1245 281.559 27.6019 277.442 30.3699C273.326 33.1378 270.117 37.072 268.222 41.6749C266.327 46.2778 265.831 51.3427 266.797 56.2292C267.763 61.1156 270.148 65.6041 273.649 69.127C277.15 72.6499 281.611 75.0491 286.467 76.021C291.323 76.993 296.357 76.4942 300.931 74.5876C305.506 72.681 309.416 69.4523 312.167 65.3098C314.918 61.1672 316.386 56.297 316.386 51.3148C316.386 48.0068 315.738 44.7311 314.48 41.6748C313.222 38.6186 311.378 35.8416 309.053 33.5025C306.729 31.1633 303.969 29.3079 300.931 28.0419C297.894 26.776 294.639 26.1245 291.351 26.1245ZM291.351 66.0366C288.457 66.0366 285.629 65.1731 283.223 63.5554C280.817 61.9377 278.941 59.6384 277.834 56.9483C276.727 54.2583 276.437 51.2982 277.002 48.4425C277.566 45.5867 278.96 42.9636 281.006 40.9048C283.052 38.8459 285.659 37.4438 288.497 36.8758C291.335 36.3078 294.277 36.5994 296.951 37.7136C299.624 38.8279 301.909 40.7148 303.517 43.1358C305.124 45.5568 305.982 48.4031 305.982 51.3148C305.982 53.2481 305.604 55.1625 304.869 56.9486C304.133 58.7347 303.055 60.3576 301.697 61.7246C300.338 63.0916 298.725 64.176 296.95 64.9158C295.175 65.6556 293.272 66.0363 291.351 66.0363V66.0366Z" fill="#222240"/>
                   <path d="M111.803 66.0982C110.141 66.5786 108.418 66.815 106.688 66.8C105.004 66.8047 103.333 66.5021 101.757 65.9067C100.22 65.3363 98.7867 64.5149 97.5152 63.4756C96.2786 62.4663 95.2557 61.2178 94.5071 59.8037C93.7389 58.3439 93.2853 56.7375 93.176 55.0893H129.176C129.025 48.4481 128.698 43.8591 127.548 40.6497C126.529 37.6628 124.9 34.9242 122.764 32.6105C120.736 30.4686 118.26 28.8078 115.515 27.7487C112.602 26.6348 109.508 26.0791 106.392 26.1104C103.002 26.0806 99.6373 26.7039 96.4799 27.9465C93.4893 29.1068 90.7707 30.8789 88.4958 33.1508C86.221 35.4228 84.4395 38.145 83.2641 41.1454C81.9465 44.4747 81.2928 48.0324 81.3403 51.6157C81.2801 55.1998 81.9342 58.7597 83.2641 62.0852C84.4604 65.0382 86.2771 67.696 88.5897 69.8765C90.92 72.0326 93.6523 73.7021 96.6283 74.7884C99.8839 75.9749 103.325 76.5634 106.787 76.526C110.391 76.5738 113.971 75.925 117.332 74.6148C115.737 73.8235 114.382 72.6156 113.41 71.1175C112.437 69.6193 111.882 67.8859 111.803 66.0982ZM97.2685 38.2686C99.7342 36.1188 102.742 35.0438 106.293 35.0435C108.001 35.0052 109.698 35.3266 111.274 35.9871C112.594 36.5457 113.773 37.3918 114.729 38.4645C115.684 39.5371 116.391 40.8096 116.798 42.1902C117.229 43.6051 117.445 45.0775 117.438 46.5574H93.1771C93.2661 44.969 93.6748 43.4153 94.3782 41.9905C95.0817 40.5657 96.0654 39.2995 97.2697 38.2686H97.2685Z" fill="#222240"/>
                   <path d="M121.738 59.5716C120.543 59.5715 119.375 59.9279 118.382 60.5957C117.389 61.2634 116.615 62.2126 116.157 63.3231C115.7 64.4337 115.58 65.6557 115.813 66.8346C116.046 68.0136 116.622 69.0966 117.466 69.9466C118.311 70.7966 119.387 71.3755 120.559 71.61C121.731 71.8445 122.945 71.7242 124.049 71.2642C125.153 70.8042 126.096 70.0252 126.76 69.0258C127.423 68.0263 127.778 66.8512 127.778 65.6492C127.778 64.0374 127.141 62.4916 126.009 61.3518C124.876 60.212 123.34 59.5717 121.738 59.5716Z" fill="#DA0000"/>
                   <path d="M165.254 66.6537C163.591 67.1341 161.868 67.3704 160.139 67.3554C158.455 67.3601 156.784 67.0575 155.207 66.4622C153.67 65.8917 152.237 65.0703 150.966 64.0311C149.729 63.0219 148.706 61.7733 147.958 60.3592C147.19 58.8993 146.736 57.2929 146.627 55.6448H182.626C182.475 49.0035 182.149 44.4145 180.998 41.2051C179.98 38.2183 178.35 35.4796 176.215 33.1659C174.187 31.0241 171.71 29.3633 168.965 28.3041C166.052 27.1902 162.958 26.6345 159.842 26.6658C156.452 26.6361 153.087 27.2593 149.93 28.5019C146.939 29.6622 144.221 31.4344 141.946 33.7063C139.671 35.9782 137.89 38.7005 136.714 41.7008C135.397 45.0302 134.743 48.5878 134.791 52.1711C134.731 55.7553 135.385 59.3153 136.714 62.641C137.911 65.5939 139.728 68.2516 142.04 70.4319C144.37 72.5883 147.103 74.2579 150.079 75.3438C153.334 76.5303 156.775 77.1188 160.238 77.0814C163.842 77.1292 167.421 76.4804 170.782 75.1702C169.187 74.3789 167.832 73.171 166.86 71.6729C165.888 70.1747 165.333 68.4413 165.254 66.6537ZM150.719 38.824C153.185 36.6742 156.193 35.5992 159.744 35.5989C161.451 35.5604 163.148 35.8815 164.725 36.5418C166.044 37.1005 167.224 37.9466 168.179 39.0192C169.134 40.0919 169.841 41.3643 170.249 42.7449C170.679 44.1598 170.895 45.6322 170.889 47.1121H146.628C146.717 45.5239 147.125 43.9705 147.828 42.5458C148.532 41.1212 149.515 39.855 150.719 38.824Z" fill="#222240"/>
                   <path d="M175.188 60.127C173.993 60.127 172.825 60.4834 171.832 61.1513C170.839 61.8191 170.065 62.7683 169.607 63.8788C169.15 64.9893 169.031 66.2114 169.264 67.3903C169.497 68.5692 170.072 69.6522 170.917 70.5021C171.761 71.3521 172.838 71.9309 174.009 72.1654C175.181 72.4 176.395 72.2796 177.499 71.8196C178.603 71.3596 179.546 70.5806 180.21 69.5812C180.874 68.5817 181.228 67.4067 181.228 66.2046C181.228 65.4065 181.072 64.6162 180.768 63.8788C180.464 63.1414 180.02 62.4715 179.459 61.9071C178.898 61.3427 178.232 60.8951 177.499 60.5896C176.766 60.2842 175.981 60.127 175.188 60.127Z" fill="#FF8200"/>
                   <path d="M38.2101 31.0611C36.752 31.0612 35.3268 31.4964 34.1145 32.3115C32.9023 33.1267 31.9575 34.2852 31.3996 35.6407C30.8417 36.9961 30.6958 38.4876 30.9803 39.9265C31.2647 41.3654 31.9669 42.6871 32.9978 43.7244C34.0288 44.7618 35.3424 45.4683 36.7724 45.7546C38.2024 46.0408 39.6846 45.894 41.0317 45.3326C42.3788 44.7712 43.5302 43.8206 44.3403 42.6008C45.1504 41.381 45.5829 39.9469 45.5831 38.4798C45.5831 37.5056 45.3924 36.5409 45.0219 35.6407C44.6514 34.7406 44.1083 33.9228 43.4237 33.2339C42.739 32.545 41.9262 31.9985 41.0316 31.6257C40.1371 31.2529 39.1783 31.061 38.2101 31.0611Z" fill="#222240"/>
                   <path d="M75.7112 38.4795C75.716 30.5081 73.2134 22.7396 68.5618 16.287C63.9102 9.83441 57.3483 5.02868 49.8162 2.55827C42.284 0.087867 34.168 0.0795337 26.6309 2.53447C19.0937 4.9894 12.5221 9.78164 7.85744 16.2247C3.19276 22.6677 0.674361 30.431 0.663002 38.4024C0.651644 46.3738 3.14791 54.1443 7.7942 60.6008C12.4405 67.0573 18.9984 71.8685 26.5286 74.3451C34.0587 76.8218 42.1746 76.8369 49.7138 74.3882H75.7112V64.0415H65.7403C72.1516 57.0927 75.7135 47.9611 75.7112 38.4795ZM38.2108 63.2222C33.3474 63.2222 28.5932 61.771 24.5494 59.0523C20.5056 56.3335 17.3538 52.4692 15.4927 47.9481C13.6315 43.4269 13.1445 38.452 14.0934 33.6524C15.0422 28.8528 17.3841 24.4441 20.8231 20.9837C24.2621 17.5234 28.6436 15.1669 33.4136 14.2122C38.1836 13.2575 43.1278 13.7475 47.621 15.6202C52.1142 17.4929 55.9547 20.6642 58.6566 24.7332C61.3586 28.8021 62.8008 33.5858 62.8008 38.4795C62.8008 45.0416 60.2101 51.335 55.5986 55.9752C50.9871 60.6154 44.7325 63.2222 38.2108 63.2222Z" fill="#222240"/>
                 </svg>
            </a>
            <div class="form-wrapper">
                <div class="card">
                <h1 class="title">Login</h1>
                <?php
                if (isset($_GET['error'])) {
                    $errorMessage = urldecode($_GET['error']);
                    // Display the error message to the user, e.g., in a div or alert.
                    echo '<div class="error-message" id="error-message">' . $errorMessage . '</div>';
                }
                ?>        
                <form action="./admin/assets/loginVerify.php" method="POST">
                    <div class="input-container">
                        <label for="#{label}">Username</label>
                        <input type="text" id="#{label}" name="username" required="required"/>
                        <div class="bar"></div>
                    </div>
                    <div class="input-container">
                        <label for="#{label}">Password</label>
                        <input type="password" id="#{label}"  name="passcode" required="required"/>
                        <div class="bar"></div>
                    </div>
                    <div class="cehck-container">
                        <label>
                            <input type="checkbox" name="remember"> Remember me for 15 days
                          </label>
                    </div>
                    <div class="button-container">
                        <button type="submit" name="submit"><span>Go</span></button>
                    </div>
                    <div class="forget">
                        <span>
                            Forget password?
                            <a href="./admin/assets/forgot.php">Reset</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
    <script>
      // Function to remove the error message after 4 seconds
      setTimeout(function() {
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
          errorMessage.style.display = 'none';
        }
      }, 4000); // 4 seconds in milliseconds
    </script>

</body>
</html>