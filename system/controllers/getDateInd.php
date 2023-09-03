<?php
function getDayIndonesia($date)
{
    if ($date != '0000-00-00') {
        $data = hari(date('D', strtotime($date)));
    } else {
        $data = '-';
    }

    return $data;
}


function hari($day)
{
    $hari = $day;

    switch ($hari) {
        case "Sun":
            $hari = "Minggu";
            break;
        case "Mon":
            $hari = "Senin";
            break;
        case "Tue":
            $hari = "Selasa";
            break;
        case "Wed":
            $hari = "Rabu";
            break;
        case "Thu":
            $hari = "Kamis";
            break;
        case "Fri":
            $hari = "Jumat";
            break;
        case "Sat":
            $hari = "Sabtu";
            break;
    }
    return $hari;
}

function tanggal_indonesia($tanggal)
{

    $bulan = array(
        1 =>       'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );


    $var = explode('-', $tanggal);

    return $var[2] . ' ' . $bulan[(int)$var[1]] . ' ' . $var[0];
    // var 0 = tanggal
    // var 1 = bulan
    // var 2 = tahun
}

function getMonthIndonesia($date)
{
    if ($date != '0000-00-00') {
        $data = bulan(date('M', strtotime($date)));
    } else {
        $data = '-';
    }

    return $data;
}


function bulan($month)
{
    $bulan = $month;

    switch ($bulan) {
        case "Jan":
            $bulan = "Januari";
            break;
        case "Feb":
            $bulan = "Februari";
            break;
        case "Mar":
            $bulan = "Maret";
            break;
        case "Apr":
            $bulan = "April";
            break;
        case "Mei":
            $bulan = "Mei";
            break;
        case "Jun":
            $bulan = "Juni";
            break;
        case "Jul":
            $bulan = "Juli";
            break;
        case "Aug":
            $bulan = "Agustus";
            break;
        case "Sep":
            $bulan = "September";
            break;
        case "Oct":
            $bulan = "Oktober";
            break;
        case "Nov":
            $bulan = "November";
            break;
        case "Dec":
            $bulan = "Desember";
            break;
    }
    return $bulan;
}
?>

