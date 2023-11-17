<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Invoice Example</title>
        

<style type="text/css">
            .invoice-box {
    max-width: 800px;
    margin: auto;
    padding: 30px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
}

.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
}

.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
    text-align: right;
}

.invoice-box table tr.top table td {
    padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
    font-size: 45px;
    line-height: 45px;
    color: #333;
}

.invoice-box table tr.information table td {
    padding-bottom: 40px;
}

.invoice-box table tr.heading td {
    background: #eee;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
}

.invoice-box table tr.details td {
    padding-bottom: 20px;
}

.invoice-box table tr.item td {
    border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
    border-bottom: none;
}

.invoice-box table tr.total td:nth-child(2) {
    border-top: 2px solid #eee;
    font-weight: bold;
}

@media only screen and (max-width: 600px) {
    .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
    }

    .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
    }
}

/** RTL **/
.invoice-box.rtl {
    direction: rtl;
    font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}

.invoice-box.rtl table {
    text-align: right;
}

.invoice-box.rtl table tr td:nth-child(2) {
    text-align: left;
}
</style>
    </head>
    <body>
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="https://course-material-dev.s3.us-east-2.amazonaws.com/logoi.png" style="width: 120%; max-width: 108px" />
                                </td>
                                @foreach($schools as $school)
                                <td class="title">
                                    <img src="{{ $school['image_url']}}" style="width: 120%; max-width: 108px" />
                                </td>
                                @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    Izesan! for School.<br />
                                    Federal Capital Territory<br />
                                    Abuja, Nigeria.
                                </td>
                                @foreach($schools as $school)
                                <td>
                                    {{ $school['school_name'] }}.<br />
                                    {{ $school['lga'] }}<br />
                                    {{ $school['email'] }}
                                </td>
                                @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>
              
                <tr class="heading">
                   
                    <td>Names</td>
                    <td>Student ID</td>
                    <td>Gender</td>
                </tr>
                @foreach($students as $student)
                    <tr class="item @if($loop->last) last @endif">
                        <td>{{ $student['first_name']. " - " . $student['last_name']  }}</td>
                        <td>{{ $student['student_id'] }}</td>
                        <td>{{ $student['gendar'] }}</td>
                    </tr>
                @endforeach
                <tr class="total">
                    <td></td>
                    <td>Total: {{ count($students) }}</td>
                </tr>
            </table>
        </div>
    </body>
</html>