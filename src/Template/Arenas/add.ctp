<div style="margin-right:auto;margin-left:0px; width:900px;">


    <form action='' method='post' enctype="multipart/form-data">
        <table style="border:none; width: 700px;">
            <tr>
                <td>dogpic:</td>
                <td>
                <!--<input type="text" name="dogpic" id="dogpic">-->
                    <input name="ufile" type="file" id="ufile" size="50" /></td>
                </td>
            </tr>




            <tr>
                <td>dogname:</td>
                <td>
                    <input type="text" name="dogname" id="dogname">
                </td>
            </tr>




            <tr>
                <td>sex:</td>
                <td>
                    <input type="text" name="sex" id="sex">
                </td>
            </tr>




            <tr>
                <td>comments:</td>
                <td style="width: 200px;">
                    <input type="text" name="comments" id="comments" size="200">
                </td>
            </tr>









            <tr>
                <td>adopted:</td>
                <td><input type="checkbox" name="adopted" id="adopted" value="1" /></td>
            </tr>





        </table>
        <!--<input type="hidden" name="token" value="<?php //echo $token; ?>" />-->
        <p><input type='submit' name='submit' value='Add'></p>
    </form>




</div>