<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Daftar Sertifikat Guru</h2>
    </div>
    <!-- End Box Head -->
    <!-- Form -->
    <div class="form">
        <p>
            <label>Nama Guru</label>
            <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_nama; ?>" disabled="true"/>
            <input type="hidden" class="field size1" name="id" value="<?php echo $guru->guru_id; ?>"/>
        </p>
    </div>
    <div class="table">
        <table style="width: 100%">
            <thead>
                <tr class="center">
                    <th>No</th>
                    <th>Nama Sertifikat</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($sertifikat->result() as $row): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td>
                            <?php echo $row->guru_sertifikat_title; ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url() . 'files/sertifikat/' . $row->guru_sertifikat_file; ?>" target="_blank">Open</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
			<tfoot>
			<form method="post" enctype="multipart/form-data" action="<?php echo base_url()
			?>admin/guru/sertifikat_upload/<?php echo $guru->guru_id;?>">
			<tr>
				<td>Upload sertifikat baru</td>
				<td><input type="text" name="guru_sertifikat_title" style="width: 100%;" /></td>
				<td><input type="file" name="guru_sertifikat_file" style="width: 100%;" /></td>
			</tr>
			<tr>
				<td colspan="3" style="text-align: right;">
					<button type="reset">Cancel</button>
					<button type="submit">Submit</button>
				</td>
			</tr>
			</form>
			</tfoot>
        </table>
        <div class="pagging">
            <div class="left">
                Showing <?php echo $sertifikat->num_rows(); ?> Certificates
            </div>
        </div>
    </div>
</div>
<!-- End Box -->