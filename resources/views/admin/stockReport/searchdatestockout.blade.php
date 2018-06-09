          <table border="0px" width="100%">
            <tr>
              <td width="30%">
                <img src="{{url('/images/Logo.JPG')}}" alt="" style="height:20px; float: left;">
              </td>
              <td width="30%">
                <div style="text-align: center; font-weight: bold; font-size: 15px;font-family: 'Khmer OS System';color: blue">Report Stock Out</div>
              </td>
              <td width="30%" style="height: 25px;">
               
              </td>
            </tr>
            <tr>
              <td>
                
              </td>
              <td>
                <div style="text-align: center;font-size: 12px;font-family: 'Khmer OS System';">Monthly Report From <b style="color:red;">{{Carbon\Carbon::parse($begin)->format('d-M-Y'). " - " . Carbon\Carbon::parse($end)->format('d-M-Y')}}</b></div>
              </td>
              <td>
                
              </td>
            </tr>
          </table>
          <div style="margin-top: 5px;margin-bottom: 5px;font-size: 12px;font-family: 'Khmer OS System';">Reported By: <b>{{Auth::user()->username}}</b></div>
          @if($stockOut->count())
          <table width="1600px" class="table-responsive" border="1px" style="border: 1px solid gray; border-collapse: collapse;" cellpadding="5px" cellspacing="0">
              <thead>
              <tr>
                  <th colspan="5" style="border-top: 1px solid #fff;border-left: 1px solid #fff;"></th>
                  <th colspan="{{$products->count()}}" style="text-align: center;font-size: 11px;font-weight: bold; padding: 2px 5px; font-family: 'Arial';">Product Code</th>
              </tr>
              <tr>
                  <th style="text-align: center;font-size: 11px;font-weight: bold;height: 30px; padding: 2px 5px; font-family: 'Arial';">No</th>
                  <th style="text-align: center;font-size: 11px;font-weight: bold; padding: 2px 5px; font-family: 'Arial';">StockOut Date</th>
                  <th style="text-align: center;font-size: 11px;font-weight: bold; padding: 2px 5px; font-family: 'Arial';">Invoice Number</th>
                  <th style="text-align: center;font-size: 11px;font-weight: bold; padding: 2px 5px; font-family: 'Arial';">Customer Number</th>
                  <th style="text-align: center;font-size: 11px;font-weight: bold; padding: 2px 5px; font-family: 'Arial';">Customer Name</th>
                  @foreach($products as $pro)
                      <th style="text-align: center;font-size: 11px;font-weight: bold; padding: 2px 5px; font-family: 'Arial';">{{$pro->productCode}}</th>
                  @endforeach
              </tr>
              </thead>
              <?php $no=1;?>
              <tbody>
              @foreach($stockOut as $out)
                  <tr>
                      <td style="text-align: center;font-size: 10px; height: 20px; font-family: 'Arial';">{{$no++}}</td>
                      <td style="text-align: center;padding-left: 3px;font-size: 10px;height: 20px; font-family: 'Arial';">{{Carbon\Carbon::parse($out->date)->format('d-M-Y')}}</td>
                      <td style="text-align: center;font-size: 10px; height: 20px; font-family: 'Arial';">
                          <?php
                          echo "CAM-IN-" . sprintf('%06d',$out->prescription->id);
                          ?>
                      </td>
                      <td style="text-align: center;font-size: 10px;height: 20px; font-family: 'Arial';">
                          <?php
                          echo "CAM-CUS-" . sprintf('%06d',$out->prescription->client->id);
                          ?>
                      </td>
                      <td style="padding-left: 3px;font-size: 10px;height: 20px; font-family: 'Arial';">{{$out->prescription->client->khname}}</td>
                      @foreach($products as $pro)

                          <?php
                          $product_id =0;
                          $qty =0;
                          $prescriptions = DB::table('prescription_product')->select('product_id',DB::raw('SUM(qty) as qty'))->where([['prescription_id','=',$out->prescription_id],['product_id','=',$pro->id],])
                              ->groupBy('product_id')
                              ->get();
                          //                                                             dump($prescriptions);
                          foreach ($prescriptions as $prescription) {
                              $product_id = $prescription->product_id;
                              $qty = $prescription->qty;
                          }
                          ?>
                          @if($pro->id==$product_id)
                              <td style="text-align: center;font-size: 10px;height: 20px; color: red; font-family: 'Arial';">{{$qty}}</td>
                          @else
                              <td style="text-align: center;font-size: 10px;height: 20px; font-family: 'Arial'; ">0</td>
                          @endif
                      @endforeach
                  </tr>
              @endforeach
              </tbody>
          </table>
          @else
            <h4 style="background-color: #dddddd; padding: 5px 15px; text-align: center;border-radius: 2px;">No Found Result</h4>
          @endif