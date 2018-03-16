
<div id="doctorFladOut">
    <label for="">Doctor Appointment</label>
    <div class="edit-form-control">
        <table>
            <tr style="font-size: 16px;">
                @foreach($doc as $do)
                    <td ><span class="label label-default ">{{\Carbon\Carbon::parse($do->date)->format('d-M-Y') ." " .\Carbon\Carbon::parse($do->time)->format('g:i A')}}</span></td>
                @endforeach
            </tr>

        </table>
    </div>
</div>