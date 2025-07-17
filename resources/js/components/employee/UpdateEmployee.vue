<template>
  <div>
    <div class="kt-portlet kt-portlet--tabs">
      <div class="kt-portlet__head">
        <div class="kt-portlet__head-toolbar">
          <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#kt_apps_user_edit_tab_1" role="tab">
                <i class="fa fa-user"></i> Data Diri
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#kt_apps_user_edit_tab_2" role="tab">
                <i class="fa fa-book-open"></i> Data Pendidikan
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#kt_apps_user_edit_tab_3" role="tab">
                <i class="fa fa-users"></i> Data Keluarga
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#kt_apps_user_edit_tab_4" role="tab">
              <i class="fa fa-dharmachakra"></i> Riwayat Jabatan
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#kt_apps_user_edit_tab_5" role="tab">
                <i class="fa fa-layer-group"></i>Riwayat Mutasi
              </a>
            </li>
            <li v-if="false" class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#kt_apps_user_edit_tab_6" role="tab">
                <i class="fa fa-suitcase"></i>Diklat
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#kt_apps_user_edit_tab_7" role="tab">
                <i class="fa fa-shield-alt"></i>Hukuman Disiplin
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#kt_apps_user_edit_tab_8" role="tab">
                <i class="fa fa-university"></i> Peningkatan Pendidikan
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#kt_apps_user_edit_tab_9" role="tab">
                <i class="fa fa-file-upload"></i> Upload Dokumen Lainya
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="kt-portlet kt-portlet--tabs">
      <div class="kt-portlet__body">
        <form action="" method="">
          <div class="tab-content">
            <div class="tab-pane active" id="kt_apps_user_edit_tab_1" role="tabpanel">
              <data-diri
                :dataDiri="form.data_diri"
                :agama="agama"
                :statusPegawai="statusPegawai"
                :statusPerkawinan="statusPerkawinan"
                :jabatan="jabatan"
                :jenisJabatan="jenisJabatan"
                :unitKerja="unitKerja"
                :privilege="privilege"
                :current-privilege="currentPrivilege"
                :education="education"
                :golongan-list="golonganList"
                :options="options"
              ></data-diri>
            </div>


            <!-----------------------------------
              DATA PENDIDIKAN
             ----------------------------------->
            <div class="tab-pane" id="kt_apps_user_edit_tab_2" role="tabpanel">
              <div class="kt-form__body" v-for="(pendidikan, pendidikanIndex) in form.pendidikans" :key="pendidikanIndex">
                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Jenjang</label>
                    <select class="form-control" v-model="form.pendidikans[pendidikanIndex].jenjang">
                      <option disabled value="" selected>Jenjang Pendidikan</option>
                      <option
                        v-for="(item, index) in education" :key="index"
                        :value="item"
                      >{{ item }}</option>
                    </select>
                  </div>
                  <div class="col-lg-6">
                    <label>Jurusan</label>
                    <input class="form-control" type="text" placeholder="Jurusan"
                      v-model="form.pendidikans[pendidikanIndex].jurusan">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Nama Sekolah</label>
                    <input class="form-control" type="text" placeholder="Nama Sekolah"
                      v-model="form.pendidikans[pendidikanIndex].nama_sekolah">
                  </div>
                  <div class="col-lg-6">
                    <label>Kota</label>
                    <input class="form-control" type="text" placeholder="Kota"
                      v-model="form.pendidikans[pendidikanIndex].kota">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Dari & Sampai</label>
                    <datepicker
                      input-class="form-control"
                      name="thn-masuk-pendidikan"
                      placeholder="Tahun Masuk"
                      v-model="form.pendidikans[pendidikanIndex].tgl_masuk"
                    >
                    </datepicker>
                  </div>
                  <div class="col-lg-6">
                    <label>&nbsp;</label>
                    <datepicker
                      input-class="form-control"
                      name="thn-keluar-pendidikan"
                      placeholder="Tahun Keluar"
                      v-model="form.pendidikans[pendidikanIndex].tgl_keluar"
                    >
                    </datepicker>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>No.Ijasah</label>
                    <input class="form-control" type="text" placeholder="No Ijasah"
                      v-model="form.pendidikans[pendidikanIndex].no_ijazah">
                  </div>
                  <div class="col-lg-6">
                    <label>Tgl. Ijasah</label>
                    <datepicker
                      input-class="form-control"
                      name="tgl-ijasah"
                      placeholder="Tanggal Ijasah"
                      v-model="form.pendidikans[pendidikanIndex].tgl_ijazah"
                    >
                    </datepicker>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Upload Dokumen</label>
                    <div class="custom-file">
                      <input type="file"
                        :name="`fileUploadPendidikan-${pendidikanIndex}`"
                        ref="fileUploadPendidikan"
                        @change="handleFileUpload($event.target.files)"
                      >
                    </div>
                  </div>
                </div>

                <div class="kt-form__actions">
                  <div class="row">
                    <div class="col-lg-12 text-right">
                      <button v-if="form.pendidikans.length > 1" class="btn btn-clean btn-bold" @click.prevent="removeItem(pendidikan, form.pendidikans)">Hapus</button>
                      <button class="btn btn-brand btn-bold" @click.prevent="addItem('pendidikan')">Tambah</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-----------------------------------
              DATA PENDIDIKAN
             ----------------------------------->


            <!-----------------------------------
              DATA KELUARGA
             ----------------------------------->
            <div class="tab-pane" id="kt_apps_user_edit_tab_3" role="tabpanel">
              <div class="kt-form__body" v-for="(keluarga, keluargaIndex) in form.keluargas" :key="keluargaIndex">
                <div class="form-group row">
                  <div class="col-lg-12">
                    <label>Nama</label>
                    <input class="form-control" type="text" name="nama_keluarga" placeholder="Nama"
                      v-model="form.keluargas[keluargaIndex].nama">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Tempat, Tanggal Lahir <span class="text-danger">*</span></label>
                    <div class="row">
                      <div class="col-lg-6 col-xl-6">
                        <input class="form-control" type="text" name="pob" placeholder="Tempat Lahir"
                          v-model="form.keluargas[keluargaIndex].tempat_lahir">
                      </div>
                      <div class="col-lg-6 col-xl-6">
                        <datepicker
                          input-class="form-control"
                          name="tgl-lahir"
                          placeholder="Tanggal Lahir"
                          v-model="form.keluargas[keluargaIndex].tgl_lahir"
                        ></datepicker>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                    <div class="kt-radio-inline">
                      <label class="kt-radio">
                        <input type="radio"
                          :name="`gender-${keluargaIndex}`"
                          :value="`M`"
                          v-model="form.keluargas[keluargaIndex].jenis_kelamin"
                        > Laki - Laki
                        <span></span>
                      </label>
                      <label class="kt-radio">
                        <input type="radio"
                          :name="`gender-${keluargaIndex}`"
                          :value="`F`"
                          v-model="form.keluargas[keluargaIndex].jenis_kelamin"
                        > Perempuan
                        <span></span>
                      </label>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Hubungan</label>
                    <select class="form-control" v-model="form.keluargas[keluargaIndex].hubungan">
                      <option disabled value="">Pilih Hubungan</option>
                      <option
                        v-for="(item, index) in hubungan" :key="index"
                        :value="item"
                      >{{ item }}</option>
                    </select>
                  </div>

                  <div class="col-lg-6">
                    <label>Pendidikan</label>
                    <select class="form-control" v-model="form.keluargas[keluargaIndex].pendidikan">
                      <option disabled value="">Jenjang Pendidikan</option>
                      <option
                        v-for="(item, index) in education" :key="index"
                        :value="item"
                      >{{ item }}</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-12">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="ket_keluarga" rows="3"
                      v-model="form.keluargas[keluargaIndex].keterangan"></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Upload Dokumen</label>
                    <div class="custom-file">
                      <input type="file"
                        :name="`fileUploadKeluarga-${keluargaIndex}`"
                        ref="fileUploadKeluarga"
                        @change="handleFileUpload($event.target.files)"
                      >
                    </div>
                  </div>
                </div>

                <div class="kt-form__actions">
                  <div class="row">
                    <div class="col-lg-12 text-right">
                      <button v-if="form.keluargas.length > 1" class="btn btn-clean btn-bold" @click.prevent="removeItem(keluarga, form.keluargas)">Hapus</button>
                      <button class="btn btn-brand btn-bold" @click.prevent="addItem('keluarga')">Tambah</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-----------------------------------
              DATA KELUARGA
             ----------------------------------->


             <!-----------------------------------
              DATA RIWAYAT JABATAN
             ----------------------------------->
            <div class="tab-pane" id="kt_apps_user_edit_tab_4" role="tabpanel">
              <div class="kt-form__body" v-for="(jabatan, jabatanIndex) in form.riwayat_jabatan" :key="jabatanIndex">
                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Unit Kerja Lama</label>
                    <input class="form-control" type="text" placeholder="Unit Kerja Lama"
                      v-model="form.riwayat_jabatan[jabatanIndex].unit_kerja_lama">
                  </div>
                  <div class="col-lg-6">
                    <label>Masa Kerja</label>
                    <input class="form-control" type="text" placeholder="Masa Kerja"
                      v-model="form.riwayat_jabatan[jabatanIndex].masa_kerja">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>No. SK Jabatan</label>
                    <input class="form-control" type="text" placeholder="No. SK Jabatan"
                      v-model="form.riwayat_jabatan[jabatanIndex].no_sk">
                  </div>
                  <div class="col-lg-6">
                    <label>Jenis Pegawai</label>
                    <input class="form-control" type="text" placeholder="Jenis Pegawai"
                      v-model="form.riwayat_jabatan[jabatanIndex].jenis_pegawai">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Tgl. SK Jabatan</label>
                    <datepicker
                      input-class="form-control"
                      name="tgl-sk-jabatan"
                      placeholder="Tgl. SK Jabatan"
                      v-model="form.riwayat_jabatan[jabatanIndex].tgl_sk"
                    ></datepicker>
                  </div>
                  <div class="col-lg-6">
                    <label>Jabatan</label>
                    <input class="form-control" type="text" placeholder="Jabatan"
                      v-model="form.riwayat_jabatan[jabatanIndex].jabatan">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>TMT SK Jabatan</label>
                    <datepicker
                      input-class="form-control"
                      name="tmt-sk-jabatan"
                      placeholder="TMT SK Jabatan"
                      v-model="form.riwayat_jabatan[jabatanIndex].tmt_sk"
                    ></datepicker>
                  </div>
                  <div class="col-lg-6">
                    <label>Rumpun Jabatan</label>
                    <input class="form-control" type="text" placeholder="Rumpun Jabatan"
                      v-model="form.riwayat_jabatan[jabatanIndex].rumpun_jabatan">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Upload Dokumen</label>
                    <div class="custom-file">
                      <input type="file"
                        :name="`fileUploadJabatan-${jabatanIndex}`"
                        ref="fileUploadJabatan"
                        @change="handleFileUpload($event.target.files)"
                      >
                    </div>
                  </div>
                </div>

                <div class="kt-form__actions">
                  <div class="row">
                    <div class="col-lg-12 text-right">
                      <button v-if="form.riwayat_jabatan.length > 1" class="btn btn-clean btn-bold" @click.prevent="removeItem(jabatan, form.riwayat_jabatan)">Hapus</button>
                      <button class="btn btn-brand btn-bold" @click.prevent="addItem('riwayat-jabatan')">Tambah</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           <!-----------------------------------
              DATA RIWAYAT JABATAN
             ----------------------------------->


           <!-----------------------------------
              DATA RIWAYAT MUTASI
             ----------------------------------->
            <div class="tab-pane" id="kt_apps_user_edit_tab_5" role="tabpanel">
              <div class="kt-form__body" v-for="(mutasi, mutasiIndex) in form.riwayat_mutasi" :key="mutasiIndex">
                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Unit Kerja Sekarang</label>
                    <input class="form-control" type="text" placeholder="Unit Kerja Sekarang"
                      v-model="form.riwayat_mutasi[mutasiIndex].unit_kerja_sekarang">
                  </div>
                  <div class="col-lg-6">
                    <label>Unit Kerja Lama</label>
                    <input class="form-control" type="text" placeholder="Unit Kerja Lama"
                      v-model="form.riwayat_mutasi[mutasiIndex].unit_kerja_lama">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>No. SK</label>
                    <input class="form-control" type="text" placeholder="No. SK"
                      v-model="form.riwayat_mutasi[mutasiIndex].no_sk">
                  </div>
                  <div class="col-lg-6">
                    <label>Tgl SK</label>
                    <datepicker
                      input-class="form-control"
                      name="tgl-sk-mutasi"
                      placeholder="Tgl. SK Mutasi"
                      v-model="form.riwayat_mutasi[mutasiIndex].tgl_sk"
                    ></datepicker>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>No. SPMT</label>
                    <input class="form-control" type="text" placeholder="No. SPMT"
                      v-model="form.riwayat_mutasi[mutasiIndex].no_spmt">
                  </div>
                  <div class="col-lg-6">
                    <label>Tgl No. SPMT</label>
                    <datepicker
                      input-class="form-control"
                      name="tgl-no-spmt-mutasi"
                      placeholder="Tgl. No. SPMT"
                      v-model="form.riwayat_mutasi[mutasiIndex].tgl_spmt"
                    ></datepicker>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-12">
                    <label>Keterangan</label>
                    <textarea class="form-control" rows="3"
                      v-model="form.riwayat_mutasi[mutasiIndex].keterangan"></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Upload Dokumen</label>
                    <div class="custom-file">
                      <input type="file"
                        :name="`fileUploadMutasi-${mutasiIndex}`"
                        ref="fileUploadMutasi"
                        @change="handleFileUpload($event.target.files)"
                      >
                    </div>
                  </div>
                </div>

                <div class="kt-form__actions">
                  <div class="row">
                    <div class="col-lg-12 text-right">
                      <button v-if="form.riwayat_mutasi.length > 1" class="btn btn-clean btn-bold" @click.prevent="removeItem(mutasi, form.riwayat_mutasi)">Hapus</button>
                      <button class="btn btn-brand btn-bold" @click.prevent="addItem('riwayat-mutasi')">Tambah</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           <!-----------------------------------
              DATA RIWAYAT MUTASI
             ----------------------------------->


           <!-----------------------------------
              DATA DIKLAT
             ----------------------------------->
            <div class="tab-pane" id="kt_apps_user_edit_tab_6" role="tabpanel">
              <div class="kt-form__body" v-for="(diklat, diklatIndex) in form.diklats" :key="diklatIndex">
                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Nama Pelatihan</label>
                    <input class="form-control" type="text" placeholder="Nama Pelatihan"
                      v-model="form.diklats[diklatIndex].pelatihan">
                  </div>
                  <div class="col-lg-6">
                    <label>Nama Institusi</label>
                    <input class="form-control" type="text" placeholder="Nama Institusi"
                      v-model="form.diklats[diklatIndex].institusi">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Tanggal Mulai</label>
                    <datepicker
                      input-class="form-control"
                      name="tgl-mulai-diklat"
                      placeholder="Tanggal Mulai"
                      v-model="form.diklats[diklatIndex].mulai"
                    >
                    </datepicker>
                  </div>
                  <div class="col-lg-6">
                    <label>Tanggal Selesai</label>
                    <datepicker
                      input-class="form-control"
                      name="tgl-selesai-diklat"
                      placeholder="Tanggal Selesai"
                      v-model="form.diklats[diklatIndex].selesai"
                    >
                    </datepicker>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Jenis Diklat</label>
                    <select class="form-control" v-model="form.diklats[diklatIndex].jenis">
                      <option disabled value="" selected>Jenis Diklat</option>
                      <option
                        v-for="(item, index) in jenisDiklat" :key="index"
                        :value="item"
                      >{{ item }}</option>
                    </select>
                  </div>
                  <div class="col-lg-6">
                    <label>No. Sertifikat</label>
                    <input class="form-control" type="text" placeholder="No. Sertifikat"
                    v-model="form.diklats[diklatIndex].no_sertifikat">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Durasi Diklat</label>
                    <input class="form-control" type="text" placeholder="Durasi Diklat"
                    v-model="form.diklats[diklatIndex].durasi">
                  </div>

                  <div class="col-lg-6">
                    <label>Upload Dokumen</label>
                    <div class="custom-file">
                      <input type="file"
                        :name="`fileUploadDiklat-${diklatIndex}`"
                        ref="fileUploadDiklat"
                        @change="handleFileUpload($event.target.files)"
                      >
                    </div>
                  </div>
                </div>

                <div class="kt-form__actions">
                  <div class="row">
                    <div class="col-lg-12 text-right">
                      <button v-if="form.diklats.length > 1" class="btn btn-clean btn-bold" @click.prevent="removeItem(diklat, form.diklats)">Hapus</button>
                      <button class="btn btn-brand btn-bold" @click.prevent="addItem('diklat')">Tambah</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           <!-----------------------------------
              DATA DIKLAT
             ----------------------------------->


           <!-----------------------------------
              DATA HUKUMAN DISIPLIN
             ----------------------------------->
            <div class="tab-pane" id="kt_apps_user_edit_tab_7" role="tabpanel">
              <div class="kt-form__body" v-for="(hukdis, hukdisIndex) in form.hukuman_disiplin" :key="hukdisIndex">
                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>No. SK Hukdis</label>
                    <input class="form-control" type="text" placeholder="No. SK Hukuman Disiplin"
                      v-model="form.hukuman_disiplin[hukdisIndex].no_sk">
                  </div>
                  <div class="col-lg-6">
                    <label>Tgl SK Hukdis</label>
                    <datepicker
                      input-class="form-control"
                      name="tgl-sk-hukdis"
                      placeholder="Tgl. SK Hukuman Disiplin"
                      v-model="form.hukuman_disiplin[hukdisIndex].tgl_sk"
                    >
                    </datepicker>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Masa Mulai Hukdis</label>
                    <datepicker
                      input-class="form-control"
                      name="masa-mulai-hukdis"
                      placeholder="Masa Mulai Berlaku Hukuman Disiplin"
                      v-model="form.hukuman_disiplin[hukdisIndex].mulai"
                    >
                    </datepicker>
                  </div>
                  <div class="col-lg-6">
                    <label>Masa Selesai</label>
                    <datepicker
                      input-class="form-control"
                      name="masa-selesai-hukdis"
                      placeholder="Masa Selesai Hukuman Disiplin"
                      v-model="form.hukuman_disiplin[hukdisIndex].selesai"
                    >
                    </datepicker>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Pejabat yang menetapkan</label>
                    <input class="form-control" type="text" placeholder="Pejabat yang menetapkan"
                      v-model="form.hukuman_disiplin[hukdisIndex].pejabat_menetapkan">
                  </div>
                  <div class="col-lg-6">
                    <label>Nama Pejabat</label>
                    <input class="form-control" type="text" placeholder="Nama Pejabat"
                      v-model="form.hukuman_disiplin[hukdisIndex].nama_pejabat">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Tingkat Hukdis</label>
                    <div class="kt-radio-list">
                      <label class="kt-radio" v-for="(item, index) in tingkatHukdis" :key="index">
                        <input type="radio"
                          :name="`tingkat-hukdis-${hukdisIndex}`"
                          :value="item"
                          v-model="form.hukuman_disiplin[hukdisIndex].tingkat"
                        >{{ item }}
                        <span></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="ket_keluarga" rows="3"
                      v-model="form.hukuman_disiplin[hukdisIndex].keterangan"
                    ></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Upload Dokumen</label>
                    <div class="custom-file">
                      <input type="file"
                        :name="`fileUploadHukdis-${hukdisIndex}`"
                        ref="fileUploadHukdis"
                        @change="handleFileUpload($event.target.files)"
                      >
                    </div>
                  </div>
                </div>

                <div class="kt-form__actions">
                  <div class="row">
                    <div class="col-lg-12 text-right">
                      <button v-if="form.hukuman_disiplin.length > 1" class="btn btn-clean btn-bold" @click.prevent="removeItem(hukdis, form.hukuman_disiplin)">Hapus</button>
                      <button class="btn btn-brand btn-bold" @click.prevent="addItem('hukuman-disiplin')">Tambah</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           <!-----------------------------------
              DATA HUKUMAN DISIPLIN
             ----------------------------------->


           <!-----------------------------------
              DATA PENINGKATAN PENDIDIKAN
             ----------------------------------->
            <div class="tab-pane" id="kt_apps_user_edit_tab_8" role="tabpanel">
              <div class="kt-form__body" v-for="(peningkatan, peningkatanIndex) in form.peningkatan_pendidikan" :key="peningkatanIndex">
                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Jenis Peningkatan Pendidikan</label>
                    <select class="form-control" v-model="form.peningkatan_pendidikan[peningkatanIndex].jenis">
                      <option disabled value="" selected>Jenis Peningkatan Pendidikan</option>
                      <option
                        v-for="(item, index) in education" :key="index"
                        :value="item"
                      >{{ item }}</option>
                    </select>
                  </div>
                  <div class="col-lg-6">
                    <label>No. Sertifikat</label>
                    <input class="form-control" type="text" placeholder="No. Sertifikat"
                      v-model="form.peningkatan_pendidikan[peningkatanIndex].no_sertifikat"
                    >
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>No. Ijin Belajar</label>
                    <input class="form-control" type="text" placeholder="Nomor Ijin Belajar"
                      v-model="form.peningkatan_pendidikan[peningkatanIndex].no_izin"
                    >
                  </div>
                  <div class="col-lg-6">
                    <label>Tgl Sertifikat</label>
                    <datepicker
                      input-class="form-control"
                      name="tgl-sertifikat-peningkatan"
                      placeholder="Tanggal Sertifikat"
                      v-model="form.peningkatan_pendidikan[peningkatanIndex].tgl_sertifikat"
                    >
                    </datepicker>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Tgl. Ijin Belajar</label>
                    <datepicker
                      input-class="form-control"
                      name="tgl-ijin-pengingkatan"
                      placeholder="Tanggal Ijin Belajar"
                      v-model="form.peningkatan_pendidikan[peningkatanIndex].tgl_izin"
                    >
                    </datepicker>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-12">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="ket_keluarga" rows="3"
                      v-model="form.peningkatan_pendidikan[peningkatanIndex].keterangan"></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Upload Dokumen</label>
                    <div class="custom-file">
                      <input type="file"
                        :name="`fileUploadPeningkatan-${peningkatanIndex}`"
                        ref="fileUploadPeningkatan"
                        @change="handleFileUpload($event.target.files)"
                      >
                    </div>
                  </div>
                </div>

                <div class="kt-form__actions">
                  <div class="row">
                    <div class="col-lg-12 text-right">
                      <button v-if="form.peningkatan_pendidikan.length > 1" class="btn btn-clean btn-bold" @click.prevent="removeItem(peningkatan, form.peningkatan_pendidikan)">Hapus</button>
                      <button class="btn btn-brand btn-bold" @click.prevent="addItem('peningkatan-pendidikan')">Tambah</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           <!-----------------------------------
              DATA PENINGKATAN PENDIDIKAN
             ----------------------------------->

             <!-----------------------------------
              DATA UPLOAD DOKUMEN LAINYA
             ----------------------------------->
            <div class="tab-pane" id="kt_apps_user_edit_tab_9" role="tabpanel">
              <div class="kt-form__body" v-for="(dokumenLain, dokumenLainIndex) in form.dokumen_lain" :key="dokumenLainIndex">

                <div class="form-group row">
                  <div class="col-lg-12">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="ket_keluarga" rows="3"
                      v-model="form.dokumen_lain[dokumenLainIndex].keterangan"></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Upload Dokumen</label>
                    <div class="custom-file">
                      <input type="file"
                        :name="`fileUploadDokumenLain-${dokumenLainIndex}`"
                        ref="fileUploadDokumenLain"
                        @change="handleFileUpload($event.target.files)"
                      >
                    </div>
                  </div>
                </div>

                <div class="kt-form__actions">
                  <div class="row">
                    <div class="col-lg-12 text-right">
                      <button v-if="form.dokumen_lain.length > 1" class="btn btn-clean btn-bold" @click.prevent="removeItem(dokumenLain, form.dokumen_lain)">Hapus</button>
                      <button class="btn btn-brand btn-bold" @click.prevent="addItem('dokumen-lain')">Tambah</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           <!-----------------------------------
              DATA UPLOAD DOKUMEN LAINYA
             ----------------------------------->

          </div>
        </form>
      </div>
    </div>

    <div class="kt-form__actions">
      <div class="row">
        <div class="col-lg-12 text-right">
          <button class="btn btn-clean btn-bold" @click.prevent="back()">Kembali</button>
          <button class="btn btn-brand btn-bold"
            :class="{ 'kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light': isSubmit }"
            :disabled="isSubmit"
            @click.prevent="update()">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DataDiri from '@/employee/partial/DataDiri';
import bus from '~/plugins/bus';
import Datepicker from 'vuejs-datepicker';
import Mixin from '~/mixins/Mixin';

export default {
  mixins: [Mixin],

  data() {
    return {
      options: {
        unitKerja: [],
        jabatan: [],
      },

      picture: null,
      documents: null,
      isSubmit: false,

      form: {
        data_diri: {
          id: null,
          nip: null,
          nrk: null,
          nama: null,
          no_seri_karpeg: null,
          alamat: null,
          jenis_kelamin: null,
          tempat_lahir: null,
          tgl_lahir: null,
          status_perkawinan: '',
          agama: '',
          nama_pasangan: null,
          no_bpjs_kesehatan: null,
          jumlah_anak: null,
          no_bpjs_ketenagakerjaan: null,
          no_npwp: null,
          nama_ibu: null,
          no_rek: null,
          no_tlp: null,
          no_ktp: null,
          email: null,
          no_kk: null,
          total_cuti: null,
          status_pegawai: null,
          unit_kerja: [],
          jenis_jabatan: null,
          jabatan: [],
          kontrak_awal: null,
          kontrak_akhir: null,
          gaji: null,
          tmt_masuk: null,
          tunjangan: null,
          bidang: null,
          golongan: '',
          privilege: '',
        },

        pendidikans: [{
          jenjang: '',
          jurusan: null,
          nama_sekolah: null,
          tgl_masuk: null,
          tgl_keluar: null,
          kota: null,
          no_ijazah: null,
          tgl_ijazah: null,
          dokumen: null,
        }],

        keluargas: [{
          nama: null,
          tempat_lahir: null,
          tgl_lahir: null,
          jenis_kelamin: null,
          hubungan: '',
          pendidikan: '',
          keterangan: null,
          dokumen: null,
        }],

        riwayat_jabatan: [{
          unit_kerja_lama: null,
          masa_kerja: null,
          no_sk: null,
          jenis_pegawai: null,
          tgl_sk: null,
          jabatan: null,
          tmt_sk: null,
          rumpun_jabatan: null,
          dokumen: null,
        }],

        riwayat_mutasi: [{
          unit_kerja_sekarang: null,
          unit_kerja_lama: null,
          no_sk: null,
          tgl_sk: null,
          no_spmt: null,
          tgl_spmt: null,
          keterangan: null,
          dokumen: null,
        }],

        diklats: [{
          pelatihan: null,
          institusi: null,
          mulai: null,
          selesai: null,
          jenis: '',
          no_sertifikat: null,
          dokumen: null,
          durasi: null,
        }],

        hukuman_disiplin: [{
          no_sk: null,
          tgl_sk: null,
          mulai: null,
          selesai: null,
          pejabat_menetapkan: null,
          nama_pejabat: null,
          tingkat: null,
          keterangan: null,
          dokumen: null,
        }],

        peningkatan_pendidikan: [{
          jenis: '',
          no_sertifikat: null,
          tgl_sertifikat: null,
          no_izin: null,
          tgl_izin: null,
          keterangan: null,
          dokumen: null,
        }],

        dokumen_lain: [{
          keterangan: null,
          dokumen: null,
        }],
      },
    };
  },

  props: {
    list: {
      type: Object,
      required: true,
    },

    agama: {
      type: Array,
      required: true,
    },

    statusPegawai: {
      type: Array,
      required: true,
    },

    statusPerkawinan: {
      type: Array,
      required: true,
    },

    jabatan: {
      type: Array,
      required: true,
    },

    jenisJabatan: {
      type: Array,
      required: true,
    },

    unitKerja: {
      type: Array,
      required: true,
    },

    privilege: {
      type: Array,
      required: true,
    },

    tingkatHukdis: {
      type: Array,
      required: true,
    },

    education: {
      type: Array,
      required: true,
    },

    hubungan: {
      type: Array,
      required: true,
    },

    golonganList: {
      type: Array,
      required: true,
    },

    currentPrivilege: {
      type: String,
      required: true,
    },

    jenisDiklat: {
      type: Array,
      required: true,
    },
  },

  components: {
    DataDiri,
    Datepicker,
  },

  methods: {
    setData() {
      this.form.data_diri.id = this.list.id;
      this.form.data_diri.nip = this.list.nip;
      this.form.data_diri.nrk = this.list.nrk;
      this.form.data_diri.nama = this.list.name;
      this.form.data_diri.no_seri_karpeg = this.list.no_seri_karpeg;
      this.form.data_diri.alamat = this.list.alamat;
      this.form.data_diri.jenis_kelamin = this.list.jenis_kelamin;
      this.form.data_diri.tempat_lahir = this.list.tempat_lahir;
      this.form.data_diri.tgl_lahir = this.list.tgl_lahir;
      this.form.data_diri.status_perkawinan = this.list.status_perkawinan || '';
      this.form.data_diri.agama = this.list.agama || '';
      this.form.data_diri.nama_pasangan = this.list.nama_pasangan;
      this.form.data_diri.no_bpjs_kesehatan = this.list.no_bpjs_kesehatan;
      this.form.data_diri.jumlah_anak = this.list.jumlah_anak;
      this.form.data_diri.no_bpjs_ketenagakerjaan = this.list.no_bpjs_ketenagakerjaan;
      this.form.data_diri.no_npwp = this.list.no_npwp;
      this.form.data_diri.nama_ibu = this.list.nama_ibu;
      this.form.data_diri.no_rek = this.list.no_rek;
      this.form.data_diri.no_tlp = this.list.no_tlp;
      this.form.data_diri.no_ktp = this.list.no_ktp;
      this.form.data_diri.email = this.list.email;
      this.form.data_diri.no_kk = this.list.no_kk;
      this.form.data_diri.total_cuti = this.list.total_cuti;
      this.form.data_diri.status_pegawai = this.list.status_pegawai;
      this.form.data_diri.unit_kerja = this.setType(this.list.unit_kerja, 'unitKerja');
      this.form.data_diri.jenis_jabatan = this.list.jenis_jabatan;
      this.form.data_diri.jabatan = this.setType(this.list.jabatan, 'jabatan');
      this.form.data_diri.kontrak_awal = this.list.kontrak_awal;
      this.form.data_diri.kontrak_akhir = this.list.kontrak_akhir;
      this.form.data_diri.gaji = this.list.gaji;
      this.form.data_diri.tmt_masuk = this.list.tmt_masuk;
      this.form.data_diri.tunjangan = this.list.tunjangan;
      this.form.data_diri.bidang = this.list.bidang;
      this.form.data_diri.golongan = this.list.golongan || '';
      this.form.data_diri.privilege = this.list.privilege;
      this.form.data_diri.foto = this.list.foto;

      this.form.pendidikans = this.parseData(this.list.pendidikans, this.form.pendidikans);
      this.form.keluargas = this.parseData(this.list.keluargas, this.form.keluargas);
      this.form.riwayat_jabatan = this.parseData(this.list.riwayat_jabatan, this.form.riwayat_jabatan);
      this.form.riwayat_mutasi = this.parseData(this.list.riwayat_mutasi, this.form.riwayat_mutasi);
      this.form.diklats = this.parseData(this.list.diklats, this.form.diklats);
      this.form.hukuman_disiplin = this.parseData(this.list.hukuman_disiplin, this.form.hukuman_disiplin);
      this.form.peningkatan_pendidikan = this.parseData(this.list.peningkatan_pendidikan, this.form.peningkatan_pendidikan);
      this.form.dokumen_lain = this.parseData(this.list.dokumen, this.form.dokumen_lain);
    },

    setOptions(data, name) {
      return data.map(item => ({
        label: item[name],
        value: item.id,
      }));
    },

    setType(data, type) {
      if (!data) return [];

      const array = [];
      data.split(",").forEach((selected) => {
        this.options[type].forEach((item) => {
          if (item.value == selected) {
            array.push(item);
          }
        });
      });

      return array;
    },

    parseData(list, form) {
      if (list && list.length > 2) {
        return JSON.parse(list);
      }

      return form;
    },

    generateType(data) {
      if (data) {
        const array = data.map(item => (item.value));
        return array.toString();
      }

      return null;
    },

    generatePendidikan(data, arr) {
      const pendidikans = [];

      data.forEach((item, index) => {
        pendidikans.push({
          jenjang: item.jenjang,
          jurusan: item.jurusan,
          nama_sekolah: item.nama_sekolah,
          tgl_masuk: this.dateFormat(item.tgl_masuk),
          tgl_keluar: this.dateFormat(item.tgl_keluar),
          kota: item.kota,
          no_ijazah: item.no_ijazah,
          tgl_ijazah: this.dateFormat(item.tgl_ijazah),
          dokumen: this.getFileName(index, arr) ? this.getFileName(index, arr) : item.dokumen,
        });
      });

      return JSON.stringify(pendidikans);
    },

    generateKeluarga(data, arr) {
      const keluargas = [];

      data.forEach((item, index) => {
        keluargas.push({
          nama: item.nama,
          tempat_lahir: item.tempat_lahir,
          tgl_lahir: this.dateFormat(item.tgl_lahir),
          jenis_kelamin: item.jenis_kelamin,
          hubungan: item.hubungan,
          pendidikan: item.pendidikan,
          keterangan: item.keterangan,
          dokumen: this.getFileName(index, arr) ? this.getFileName(index, arr) : item.dokumen,
        });
      });

      return JSON.stringify(keluargas);
    },

    generateRiwayatJabatan(data, arr) {
      const riwayatJabatans = [];

      data.forEach((item, index) => {
        riwayatJabatans.push({
          unit_kerja_lama: item.unit_kerja_lama,
          masa_kerja: item.masa_kerja,
          no_sk: item.no_sk,
          jenis_pegawai: item.jenis_pegawai,
          tgl_sk: this.dateFormat(item.tgl_sk),
          jabatan: item.jabatan,
          tmt_sk: this.dateFormat(item.tmt_sk),
          rumpun_jabatan: item.rumpun_jabatan,
          dokumen: this.getFileName(index, arr) ? this.getFileName(index, arr) : item.dokumen,
        });
      });

      return JSON.stringify(riwayatJabatans);
    },

    generateRiwayatMutasi(data, arr) {
      const riwayatMutasis = [];

      data.forEach((item, index) => {
        riwayatMutasis.push({
          unit_kerja_sekarang: item.unit_kerja_sekarang,
          unit_kerja_lama: item.unit_kerja_lama,
          no_sk: item.no_sk,
          tgl_sk: this.dateFormat(item.tgl_sk),
          no_spmt: item.no_spmt,
          tgl_spmt: this.dateFormat(item.tgl_spmt),
          keterangan: item.keterangan,
          dokumen: this.getFileName(index, arr) ? this.getFileName(index, arr) : item.dokumen,
        });
      });

      return JSON.stringify(riwayatMutasis);
    },

    generateDiklat(data, arr) {
      const diklats = [];

      data.forEach((item, index) => {
        diklats.push({
          pelatihan: item.pelatihan,
          institusi: item.institusi,
          mulai: this.dateFormat(item.mulai),
          selesai: this.dateFormat(item.selesai),
          jenis: item.jenis,
          no_sertifikat: item.no_sertifikat,
          durasi: item.durasi,
          dokumen: this.getFileName(index, arr) ? this.getFileName(index, arr) : item.dokumen,
        });
      });

      return JSON.stringify(diklats);
    },

    generateHukumanDisiplin(data, arr) {
      const hukumanDisiplins = [];

      data.forEach((item, index) => {
        hukumanDisiplins.push({
          no_sk: item.no_sk,
          tgl_sk: this.dateFormat(item.tgl_sk),
          mulai: this.dateFormat(item.mulai),
          selesai: this.dateFormat(item.selesai),
          pejabat_menetapkan: item.pejabat_menetapkan,
          nama_pejabat: item.nama_pejabat,
          tingkat: item.tingkat,
          keterangan: item.keterangan,
          dokumen: this.getFileName(index, arr) ? this.getFileName(index, arr) : item.dokumen,
        });
      });

      return JSON.stringify(hukumanDisiplins);
    },

    generatePeningkatanPendidikan(data, arr) {
      const peningkatanPendidikans = [];

      data.forEach((item, index) => {
        peningkatanPendidikans.push({
          jenis: item.jenis,
          no_sertifikat: item.no_sertifikat,
          tgl_sertifikat: this.dateFormat(item.tgl_sertifikat),
          no_izin: item.no_izin,
          tgl_izin: this.dateFormat(item.tgl_izin),
          keterangan: item.keterangan,
          dokumen: this.getFileName(index, arr) ? this.getFileName(index, arr) : item.dokumen,
        });
      });

      return JSON.stringify(peningkatanPendidikans);
    },

    generateDokumenLain(data, arr) {
      const dokumenLain = [];

      data.forEach((item, index) => {
        dokumenLain.push({
          keterangan: item.keterangan,
          dokumen: this.getFileName(index, arr) ? this.getFileName(index, arr) : item.dokumen,
        });
      });

      return JSON.stringify(dokumenLain);
    },

    getPictureUpload(data) {
      if (data) {
        this.picture = data;
      }
    },

    generateData() {
      const filePendidikan = this.generateArrFile(this.$refs.fileUploadPendidikan, 'pendidikan');
      const fileKeluarga = this.generateArrFile(this.$refs.fileUploadKeluarga, 'keluarga');
      const fileJabatan = this.generateArrFile(this.$refs.fileUploadJabatan, 'jabatan');
      const fileMutasi = this.generateArrFile(this.$refs.fileUploadMutasi, 'mutasi');
      const fileDiklat = this.generateArrFile(this.$refs.fileUploadDiklat, 'diklat');
      const fileHukdis = this.generateArrFile(this.$refs.fileUploadHukdis, 'hukdis');
      const filePeningkatan = this.generateArrFile(this.$refs.fileUploadPeningkatan, 'peningkatan');
      const fileDokumenLain = this.generateArrFile(this.$refs.fileUploadDokumenLain, 'dokumen');

      this.documents = [...filePendidikan, ...fileKeluarga, ...fileJabatan, ...fileMutasi, ...fileDiklat, ...fileHukdis, ...filePeningkatan, ...fileDokumenLain]

      const {
        id,
        nip,
        nrk,
        nama,
        no_seri_karpeg,
        alamat,
        jenis_kelamin,
        tempat_lahir,
        tgl_lahir,
        status_perkawinan,
        agama,
        nama_pasangan,
        no_bpjs_kesehatan,
        jumlah_anak,
        no_bpjs_ketenagakerjaan,
        no_npwp,
        nama_ibu,
        no_rek,
        no_tlp,
        no_ktp,
        email,
        no_kk,
        total_cuti,
        status_pegawai,
        unit_kerja,
        jenis_jabatan,
        jabatan,
        kontrak_awal,
        kontrak_akhir,
        gaji,
        tmt_masuk,
        tunjangan,
        bidang,
        golongan,
        privilege,
      } = this.form.data_diri;

      return {
        id: id,
        nip: nip,
        nrk: nrk,
        name: nama,
        no_seri_karpeg: no_seri_karpeg,
        alamat: alamat,
        jenis_kelamin: jenis_kelamin,
        tempat_lahir: tempat_lahir,
        tgl_lahir: this.dateFormat(tgl_lahir),
        status_perkawinan: status_perkawinan,
        agama: agama,
        nama_pasangan: nama_pasangan,
        no_bpjs_kesehatan: no_bpjs_kesehatan,
        jumlah_anak: this.numberFormat(jumlah_anak),
        no_bpjs_ketenagakerjaan: no_bpjs_ketenagakerjaan,
        no_npwp: no_npwp,
        nama_ibu: nama_ibu,
        no_rek: no_rek,
        no_tlp: no_tlp,
        no_ktp: no_ktp,
        email: email,
        no_kk: no_kk,
        total_cuti: total_cuti,
        status_pegawai: status_pegawai,
        unit_kerja: this.generateType(unit_kerja),
        jenis_jabatan: jenis_jabatan,
        jabatan: this.generateType(jabatan),
        kontrak_awal: this.dateFormat(kontrak_awal),
        kontrak_akhir: this.dateFormat(kontrak_akhir),
        gaji: this.numberFormat(gaji),
        tmt_masuk: this.dateFormat(tmt_masuk),
        tunjangan: this.numberFormat(tunjangan),
        bidang: bidang,
        golongan: golongan,
        privilege: privilege,
        foto: this.picture ? this.picture.name : this.form.data_diri.foto,

        pendidikans: this.generatePendidikan(this.form.pendidikans, filePendidikan),
        keluargas: this.generateKeluarga(this.form.keluargas, fileKeluarga),
        riwayat_jabatan: this.generateRiwayatJabatan(this.form.riwayat_jabatan, fileJabatan),
        riwayat_mutasi: this.generateRiwayatMutasi(this.form.riwayat_mutasi, fileMutasi),
        diklats: this.generateDiklat(this.form.diklats, fileDiklat),
        hukuman_disiplin: this.generateHukumanDisiplin(this.form.hukuman_disiplin, fileHukdis),
        peningkatan_pendidikan: this.generatePeningkatanPendidikan(this.form.peningkatan_pendidikan, filePeningkatan),
        dokumen: this.generateDokumenLain(this.form.dokumen_lain, fileDokumenLain),
      };
    },

    generateFIle(documents, picture) {
      const formData = new FormData();

      if (documents) {
        documents.forEach((item) => {
          formData.append("document[]", item.file, item.name);
        });
      }

      if (picture) {
        formData.append("picture", picture.file, picture.name);
      }

      return formData;
    },

    updateData(data) {
      return new Promise((resolve) => {
        this.axios.post(`/employee/update/${this.form.data_diri.id}`, data)
          .then(() => {
            resolve();
          })
          .catch((error) => {
            console.log('update error', error);
          });
      });
    },

    updateFile(formData) {
      return new Promise((resolve) => {
         this.axios.post('/employee/upload/', formData)
          .then((result) => {
            resolve();
          })
          .catch((error) => {
            console.log('upload error', error);
          });
      });
    },

    async update() {
      this.isSubmit = true;
      const data = await this.generateData();
      const file = await this.generateFIle(this.documents, this.picture);

      await this.updateData(data);
      await this.updateFile(file);
      await this.back();
    },

    back() {
      if (this.currentPrivilege === 'Administrator') {
        window.location.href = `/employee/show/${this.form.data_diri.id}`;
      } else {
        window.location.href = '/profile';
      }
    },

    setEmployeeId(id) {
      this.$store.dispatch('setEmployeeId', id);
    },
  },

  mounted() {
    bus.$on('set-picture-upload', this.getPictureUpload);
  },

  beforeDestroy() {
    bus.$off('set-picture-upload', this.getPictureUpload);
  },

  created() {
    this.options.unitKerja = this.setOptions(this.unitKerja, 'title');
    this.options.jabatan = this.setOptions(this.jabatan, 'name');
    this.setData();
    this.setEmployeeId(this.list.id);
  },
}
</script>
