<body style="background:#fff; font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif;">
<div style="margin:25px;">
<div style="background:#f5f5f5; padding:10px 15px; border-radius:10px; width:800px; margin:0 auto;">
<div style="background:#FFFFFF">
<br>
<br>
<div style="text-align:center"><img src="<?php echo base_url();?>assets/images/profile/<?php echo $restaurant_id.'.png'; ?>" height="114px;"></div>
<div style="text-align:center; color:#d12c37; font-size:26px;"><?php //echo $subject;?></div>
<br>
</div>
 <audio controls>
  <source src="horse.ogg" type="audio/ogg">
  <source src="<?php echo base_url();?>assets/test.mp3" controls autoplay loop preload="auto" type="audio/mpeg">
Your browser does not support the audio element.
</audio> 
<embed src="<?php echo base_url();?>assets/test.mp3" width="180" height="90" loop="false" autostart="false" hidden="true" />
</div>
</div>
</body>


<script type="text/javascript"> 
        function fakeClick(fn) {
            var $a = $('<a href="#" id="fakeClick"></a>');
                $a.bind("click", function(e) {
                    e.preventDefault();
                    fn();
                });

            $("body").append($a);

            var evt, 
                el = $("#fakeClick").get(0);

            if (document.createEvent) {
                evt = document.createEvent("MouseEvents");
                if (evt.initMouseEvent) {
                    evt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
                    el.dispatchEvent(evt);
                }
            }

            $(el).remove();
        }

        $(function() {
            var video = $("#someVideo").get(0);

            fakeClick(function() {
                video.play();
            });
        });

        </script> 