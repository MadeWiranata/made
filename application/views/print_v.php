<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
</head>
<div class="modal-dialog" role="document">

    <body>
    <img align="left"  src="<?= base_url() ?>picture/kb.png" class="img-circle"
                                        alt="User Image" height="24" weight="24">
<br>
</br>
        <table>
            
            <?php
            foreach($nasabah as $mde) : ?>
                <tr>
                    <td style='font-weight: bold'>General Information</td>
                </tr>
                <tr>
                    <td>Nama Tertanggung</td>
                    <td> : </td>
                    <td><?= $mde->nama ?></td>
                </tr>
                <tr>
                    <td>Periode Pertanggungan</td>
                    <td> : </td>
                    <td><?= $mde->date_from ?> <?= $mde->date_to ?></td>
                </tr>
                <tr>
                    <td>Harga Pertanggungan</td>
                    <td> : </td>
                    <td><?= $mde->harganew ?></td>
                </tr>
                    <td></br></td>
                <tr>
                    <td style='font-weight: bold'>Coverage Information</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Jenis Pertanggungan</td>
                    <td> : </td>
                    <td><?= $mde->jenis ?></td>
                </tr>
                <tr>
                    <td>Resiko Pertanggungan</td>
                    <td> : </td>
                    <td><?= $mde->ket ?></td>
                </tr>
                <td></br></td>
                <tr>
                    <td style='font-weight: bold'>Premium Calculation</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Periode Pertanggungan</td>
                    <td> : </td>
                    <td><?= $mde->date_from ?> <?= $mde->date_to ?></td>
                </tr>
                <tr>
                    <td>Premi Kendaraan</td>
                    <td> : </td>
                    <td><?= $mde->preminew ?></td>
                </tr>
                <tr>
                    <td>Banjir : </td>
                    <td> : </td>
                    <td><?= $mde->prebanjirnew ?></td>
                </tr>
                <tr>
                    <td>Gempa : </td>
                    <td> : </td>
                    <td><?= $mde->pregempanew ?></td>
                </tr>
                <td></br></td>
                <tr>
                    <td style='font-weight: bold'>Total Premi : </td>
                    <td> : </td>
                    <td><?= $mde->total ?></td>
                </tr>
            <?php endforeach ?>
            
        </table>
        
        <script type="text/javascript">
            window.print();
        </script>
        
    </body>
</html>

    
