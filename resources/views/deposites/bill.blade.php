<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Checkout Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

     

        #printButton {
            display: inline-block;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        @media print {
            #printButton {
                display: none;
            }

            .link {
                display: none;
            }

            #container {
                width: 100%;
                margin: 0;
            }
        }
        .company-details{
            padding: 12px;
        
            border: 1px solid #000;
        }
        .mylogo{
            
            margin-bottom: -7.5rem;
        }
    </style>
</head>

<body>
  <div style="margin-bottom: 7rem">
    <a class="link" class=" btn btn-primary " href="{{ url('/') }}">Go Home</a>
    <a class="link" class=" btn btn-secondary" href="{{ url()->previous() }}">Go Back</a>
  </div>

    <!-- Bill 1 -->
    <div class="bill-content mb-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="d-flex justify-content-between px-4 mylogo">
                    <div class="text-center ">
                        @if ($owner->logo)
                            <img src="{{ asset($owner->logo) }}" alt="Company Logo" style="width: 80px; height:80px"
                                class="company-logo rounded-circle text-center">
                        @endif  
                        <br> Ref No: {{ $deposited->id }} 

                    </div>
                    <div>
                        @if($owner->pan_number)
                        Pan: {{ $owner->pan_number }} <br>
                        @endif
                        @if ($owner->reg_number)
                            
                        GSTIN: {{ $owner->reg_number }}
                        @endif
                    </div>
                   </div>
                <div class="company-details row">
                    <div class="col-9 mx-auto">
                       <div class="">
                     
                        <div class="px-3 text-center">
                            <h4 class="fw-bold">{{ $owner->company_name }}</h4>
                            <span class="">{{ $owner->address }}</span> <br>
                            <span class="">{{ $owner->contact }}</span>
                            <h6 class=" text-info">Receipt</h6>
                           
                        </div>
                       </div>
                    </div>
                    <div class="float-end">
                        <span class="float-end"><strong> Date:</strong> {{ $deposited->dod }}</span>
                    </div>
     
                    <div class="px-4">
                        <table class="table table-bordered text-center">
                            <tr>
                                <th>Customer Name</th>
                                <th>Customer ID</th>
                                <th>Deposite</th>
                                <th>Fine</th>
                                <th>Due Left</th>
                            </tr>
                            <tr>
                                <td>{{ $deposited->customer->name }}</td>
                                <td>{{ $deposited->customer->cid }}</td>
                                <td>Rs. {{ $deposited->deposite_amount }}</td>
                                <td>Rs. {{ $deposited->fine?? '0' }}</td>
                                <td>Rs. {{ $deposited->due ?? '0' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="pt-5">
                        <span>_______________</span> <br>
                        <span>Signature</span>
                    </div>
               
                    <div class="text-center">
                        Thank you for choosing us!
                      
                    </div>
                </div>
               
            </div>
        
        </div>
   
    </div>

   

    <button type="submit" id="printButton" onclick="printBill()" class="btn btn-success mt-2">
        Make Print
    </button>

    <script>
        function printBill() {
            document.getElementById('printButton').style.display = 'none';
            window.print();
            document.getElementById('printButton').style.display = 'block';
        }
        //on ctr +p 

    </script>
</body>

</html>
