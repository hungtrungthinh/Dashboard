
<div class="modal fade" tabindex="-1" role="dialog"  id="resClosedModal" style="z-index:111111; overflow-y:hidden; height:75%; display:none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Restaurant Closed</h3>
      </div>
      <div class="modal-body">
      
        
        <h4 class="text--capitalize">Restaurant Timings</h4>
        <hr>
        
        <table style=" width:100%">
        <tbody>
            <tr>
              <td>Sunday</td>
              <td>
                <ul>
                    <li ng-show="timings[0]['start_at']">{{timings[0]['start_at'] | date : 'h:mm a' }} - {{timings[0]['end_at'] | date : 'h:mm a' }}</li>
                    <li ng-hide="timings[0]['start_at']">Closed</li>
                </ul>
              </td>
            </tr>
            <tr>
              <td>Monday</td>
              <td>
                <ul>
                    <li ng-show="timings[1]['start_at']">{{timings[1]['start_at'] | date : 'h:mm a' }} - {{timings[1]['end_at'] | date : 'h:mm a' }}</li>
                    <li ng-hide="timings[1]['start_at']">Closed</li>
                </ul>
              </td>
            </tr>
            <tr>
              <td>Tuesday</td>
              <td>
                <ul>
                    <li ng-show="timings[2]['start_at']">{{timings[2]['start_at'] | date : 'h:mm a' }} - {{timings[2]['end_at'] | date : 'h:mm a' }}</li>
                    <li ng-hide="timings[2]['start_at']">Closed</li>
                </ul>
              </td>
            </tr>
            <tr>
              <td>Wednesday</td>
              <td>
                <ul>
                    <li ng-show="timings[3]['start_at']">{{timings[3]['start_at'] | date : 'h:mm a' }} - {{timings[3]['end_at'] | date : 'h:mm a' }}</li>
                    <li ng-hide="timings[3]['start_at']">Closed</li>
                </ul>
              </td>
            </tr>
            <tr>
              <td>Thursday</td>
              <td>
                <ul>
                    <li ng-show="timings[4]['start_at']">{{timings[4]['start_at'] | date : 'h:mm a' }} - {{timings[4]['end_at'] | date : 'h:mm a' }}</li>
                    <li ng-hide="timings[4]['start_at']">Closed</li>
                </ul>
              </td>
            </tr>
            <tr>
              <td>Friday</td>
              <td>
                <ul>
                    <li ng-show="timings[5]['start_at']">{{timings[5]['start_at'] | date : 'h:mm a' }} - {{timings[5]['end_at'] | date : 'h:mm a' }}</li>
                    <li ng-hide="timings[5]['start_at']">Closed</li>
                </ul>
              </td>
            </tr>
            <tr>
              <td>Saturday</td>
              <td>
                <ul>
                    <li ng-show="timings[6]['start_at']">{{timings[6]['start_at'] | date : 'h:mm a' }} - {{timings[6]['end_at'] | date : 'h:mm a' }}</li>
                    <li ng-hide="timings[6]['start_at']">Closed</li>
                </ul>
              </td>
            </tr>
        </tbody>
      </table>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

 
 

    
    
    
  </body>
</html>
