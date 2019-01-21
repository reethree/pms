<html>
    <head>
        <title>@yield('title')</title>
        <style>
            .clearfix:after {
              content: "";
              display: table;
              clear: both;
            }

            .left {
                float: left;
            }

            .right {
                float: right;
            }

            .text-right {
                text-align: right;
            }

            .text-center {
                text-align: center;
            }

            .text-left {
                text-align: left;
            }

            a {
              color: #0087C3;
              text-decoration: none;
            }

            body {
              position: relative;
              width: 100%;  
              height: 100%; 
              margin: 0 auto; 
              color: #555555;
              background: #FFFFFF; 
              font-family: Arial, sans-serif; 
              font-size: 14px; 
            }

            #header {
              padding: 10px 0;
              margin-bottom: 20px;
              border-bottom: 1px solid #000;
            }

            #title {
                font-size: 20px;
                text-align: center;
                margin-bottom: 20px;
            }

            #logo {
              float: left;
              margin-top: 8px;
            }

            #logo img {
              height: 70px;
            }

            #company {
              float: right;
              text-align: right;
            }


            #details {
              /*margin-bottom: 20px;*/
            }

            #client {
              padding-left: 6px;
              border-left: 6px solid #000;
              float: left;
            }

            #client .to {
              color: #777777;
            }

            h2.name {
              font-size: 1.4em;
              font-weight: normal;
              margin: 0;
            }

            #invoice {
              float: right;
              text-align: right;
            }

            #invoice h1 {
              color: #0087C3;
              font-size: 2.4em;
              line-height: 1em;
              font-weight: normal;
              margin: 0  0 10px 0;
            }

            #invoice .date {
              font-size: 1.1em;
              color: #777777;
            }

            table {
              width: 100%;
              border-collapse: collapse;
              border-spacing: 0;
              margin-bottom: 20px;
              font-size: 12px;
              border-color: #000;
            }

            table th,
            table td {
              padding: 2px 0;
            /*  background: #EEEEEE;*/
              /*text-align: center;*/
              /*border-bottom: 1px solid #FFFFFF;*/
            }
            table.table td {
                border-bottom: 1px solid #000;
            }
            table th {
              white-space: nowrap;        
              font-weight: normal;
              padding: 5px;
                border-bottom: 1px solid;
                font-weight: bold;
            }

            table td {
              text-align: left;
              padding: 3px;
            }

            table.grid td {
                border-right: 1px solid;
            }

            table td.padding-10 {
                padding: 0 10px;
            }

            table td h3{
              color: #57B223;
              font-size: 1.2em;
              font-weight: normal;
              margin: 0 0 0.2em 0;
            }

            table .no {
              color: #FFFFFF;
              font-size: 1.6em;
              background: #57B223;
            }

            table .desc {
              text-align: left;
            }

            table .unit {
              background: #DDDDDD;
            }

            table .qty {
            }

            table .total {
              background: #57B223;
              color: #FFFFFF;
            }

            table td.unit,
            table td.qty,
            table td.total {
              font-size: 1.2em;
            }

            table tbody tr:last-child td {
              border-bottom: none;
            }

            table tfoot td {
              padding: 10px 20px;
              background: #FFFFFF;
              border-bottom: none;
              font-size: 1.2em;
              white-space: nowrap; 
              border-top: 1px solid #000; 
            }

            table tfoot tr:first-child td {
              border-top: none; 
            }

            table tfoot tr:last-child td {
              color: #57B223;
              font-size: 1.4em;
              border-top: 1px solid #000; 

            }

            table tfoot tr td:first-child {
              border: none;
            }

            #thanks{
              font-size: 2em;
              margin-bottom: 50px;
            }

            #notices{
              padding-left: 6px;
              border-left: 6px solid #000;  
            }

            #notices .notice {
              font-size: 1.2em;
            }

            #footer {
              /*color: #777777;*/
              width: 100%;
              /*height: 30px;*/
              position: absolute;
              bottom: 0;
              border-top: 1px solid #000;
              padding: 8px 0;
              text-align: center;
            }
            body{
                            background:#f2f2f2;
                            font-size: 14px;
                            font-family: 'Open Sans', sans-serif;
                        }
                        .wrap{
                            width: 100%;
                            background:#f2f2f2;
                        }
                        .container{
                            width:800px;
            /*                max-width: 600px;*/
                            margin: 0 auto;
                            border: 1px solid #e3e3e3;
                        }
                        .content{
                            background:#FFF;
                            min-height:200px;
                            padding:50px;
                        }
                        .red-line{
                            background: #FFF;
                        }
                        .red-line div{
                            border-top:8px solid #C1272D;
                            width: 50%;
                        }
                        .logo{
                            width:100%;   
                        }
                        .footer-logo{
                            margin-top: 100px;
                        }
                        .logo img, .footer-logo img{
                            width: 120px;
                        }
                        .sayhi{
                            color:#666666;
                        /*    font-family: 'Arial';*/
                            padding-top: 30px;
                        }
                        .sayhi h2{
                            font-size:16px;
                        }
                        .message{
                            /*background:#F2F2F2;*/
                            padding:5px 0;
                            color:#000;
                            font-size: 14px
                        }
                        .btn{
                            margin-top:30px;
                            margin-top:15px;
                            width:160px;
                            text-align: center;
                            display: block;
                            font-family: 'Arial';
                            padding:10px 20px;
                            background:#C1272D;
                            color:#FFF;
                            text-decoration: none;
                        }
                        h2{
                            font-weight: normal;
                        }

                        /* ----------- iPhone 4 and 4S ----------- */

                        /* Portrait and Landscape */
                        @media only screen 
                          and (min-device-width: 320px) 
                          and (max-device-width: 480px)
                          and (-webkit-min-device-pixel-ratio: 2) {
                              img.image-laptop{
                                  display: none;
                              }
                        }

                        /* Portrait */
                        @media only screen 
                          and (min-device-width: 320px) 
                          and (max-device-width: 480px)
                          and (-webkit-min-device-pixel-ratio: 2)
                          and (orientation: portrait) {
                              img.image-laptop{
                                  display: none;
                              }
                        }

                        /* Landscape */
                        @media only screen 
                          and (min-device-width: 320px) 
                          and (max-device-width: 480px)
                          and (-webkit-min-device-pixel-ratio: 2)
                          and (orientation: landscape) {
                              img.image-laptop{
                                  display: none;
                              }
                        }

                        /* ----------- iPhone 5 and 5S ----------- */

                        /* Portrait and Landscape */
                        @media only screen 
                          and (min-device-width: 320px) 
                          and (max-device-width: 568px)
                          and (-webkit-min-device-pixel-ratio: 2) {
                              img.image-laptop{
                                  display: none;
                              }
                        }

                        /* Portrait */
                        @media only screen 
                          and (min-device-width: 320px) 
                          and (max-device-width: 568px)
                          and (-webkit-min-device-pixel-ratio: 2)
                          and (orientation: portrait) {
                              img.image-laptop{
                                  display: none;
                              }
                        }

                        /* Landscape */
                        @media only screen 
                          and (min-device-width: 320px) 
                          and (max-device-width: 568px)
                          and (-webkit-min-device-pixel-ratio: 2)
                          and (orientation: landscape) {
                              img.image-laptop{
                                  display: none;
                              }
                        }

                        /* ----------- iPhone 6 ----------- */

                        /* Portrait and Landscape */
                        @media only screen 
                          and (min-device-width: 375px) 
                          and (max-device-width: 667px) 
                          and (-webkit-min-device-pixel-ratio: 2) { 
                              img.image-laptop{
                                  display: none;
                              }
                        }

                        /* Portrait */
                        @media only screen 
                          and (min-device-width: 375px) 
                          and (max-device-width: 667px) 
                          and (-webkit-min-device-pixel-ratio: 2)
                          and (orientation: portrait) { 
                              img.image-laptop{
                                  display: none;
                              }
                        }

                        /* Landscape */
                        @media only screen 
                          and (min-device-width: 375px) 
                          and (max-device-width: 667px) 
                          and (-webkit-min-device-pixel-ratio: 2)
                          and (orientation: landscape) { 
                              img.image-laptop{
                                  display: none;
                              }
                        }

                        /* ----------- iPhone 6+ ----------- */

                        /* Portrait and Landscape */
                        @media only screen 
                          and (min-device-width: 414px) 
                          and (max-device-width: 736px) 
                          and (-webkit-min-device-pixel-ratio: 3) { 
                              img.image-laptop{
                                  display: none;
                              }
                        }

                        /* Portrait */
                        @media only screen 
                          and (min-device-width: 414px) 
                          and (max-device-width: 736px) 
                          and (-webkit-min-device-pixel-ratio: 3)
                          and (orientation: portrait) { 
                              img.image-laptop{
                                  display: none;
                              }
                        }

                        /* Landscape */
                        @media only screen 
                          and (min-device-width: 414px) 
                          and (max-device-width: 736px) 
                          and (-webkit-min-device-pixel-ratio: 3)
                          and (orientation: landscape) { 
                              img.image-laptop{
                                  display: none;
                              }
                        }
            @media print {
                body {
                    color: #000;
                    background: #fff;
                }
                @page {
                    size: auto;   /* auto is the initial value */
                    margin-top: 114px;
                    margin-bottom: 90px;
                    margin-left: 38px;
                    margin-right: 75px;
                    font-weight: bold;
                }
                .print-btn {
                    display: none;
                }
            }
            </style>
    </head>
    <body>
        <div id="main">
            
            @yield('content')

        </div>
    </body>
</html>