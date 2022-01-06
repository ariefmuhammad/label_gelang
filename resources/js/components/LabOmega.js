import React, { Component } from "react";
import Select from 'react-select';

class LabOmega extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            // dokter: [],
            selectDokter : [],
            // ID: "",
            // NAMA_GELAR: "",
            selectPetugasLab : [],
            tindakan: [],
            cari: "",
            awalan: "%10",
            tanggal_masuk: "",
            status: "-",
            nama_dokter: "Dokter Pemesan",
            nama_petugas_lab: "Petugas Laboratorium",
            // nama_tindakan: [],
            add_tindakan: [],
            hasil: "",
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.renderCari = this.renderCari.bind(this);
        this.awalanChange = this.awalanChange.bind(this);
        this.tanggalmasukChange = this.tanggalmasukChange.bind(this);
        this.statusChange = this.statusChange.bind(this);
        this.namaDokterChange = this.namaDokterChange.bind(this);
        this.namaPetugasLabChange = this.namaPetugasLabChange.bind(this);
        // this.tindakanChange = this.tindakanChange.bind(this);
        this.tarifChange = this.tarifChange.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
        this.totalTarifChange = this.totalTarifChange.bind(this);

    }

    componentWillUnmount() {
        // fix Warning: Can't perform a React state update on an unmounted component
        this.setState = (state,callback)=>{
            return;
        };
    }

    getTodayDate() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd;
        }
        if(mm<10){
            mm='0'+mm;
        }
        var terbalik = yyyy+'-'+mm+'-'+dd;
        return terbalik;
    }

    tanggalmasukChange(e) {
        this.setState({
            tanggal_masuk: e.target.value
        });
    }

    awalanChange(e) {
        this.setState({
            awalan: e.target.value
        });
    }

    statusChange(e) {
        console.log(e)
        this.setState({
            // status: e.target.value
            status: e.label,
        });
    }

    handleChange(e) {
        this.setState({
            cari: e.target.value
        });
        // console.log(e.target.value);
    }

    // tindakanChange(e, i) {
    //     this.state.nama_tindakan[i] = e.target.value
    //     this.setState({
    //         nama_tindakan: this.state.nama_tindakan
    //     });
    // }



    tarifChange(e, i) {
        // this.state.add_tindakan[i] = e.target.value
        // this.setState({
        //     add_tindakan: this.state.add_tindakan
        // });

        this.state.add_tindakan[i] = e.label
        this.setState({
            add_tindakan: this.state.add_tindakan
        });


        // this.setState({
        //     tarif: e.target.value
        // });
    }

    namaDokterChange(e) {
        console.log(e)
        this.setState({
            // ID:e.value, 
            nama_dokter:e.label,
            // nama_dokter: e.target.value
        });
    }

    namaPetugasLabChange(e) {
        console.log(e)
        this.setState({
            // ID:e.value, 
            nama_petugas_lab:e.label,
            // nama_petugas_lab: e.target.value
        });
    }



    handleSubmit(e) {
        e.preventDefault();
        axios
            .post("/", {
                cari: this.state.cari
            })
            .then(response => {
                this.setState({
                    data: [response.data.cari],
                    cari: "",
                    awalan: "%10",
                    tanggal_masuk: this.getTodayDate()
                });
                console.log("from handle sumit", response);
                // console.log(this.state.data);
            })
            .catch(error => {
                console.log(error.message);
            });
    }

    async getPetugasLab() {

        const res = await axios.get('/petugas_lab/data')
        const data = res.data
    
        const options = data.map(d => ({
          "value" : d.ID,
          "label" : d.NAMA_GELAR
    
        }))
    
        this.setState({selectPetugasLab: options})
    }

    async getDokter() {
        // axios.get(`/dokter/data`).then(response => {
        //     this.setState({
        //         dokter: response.data,
        //     });
        //     // console.log(response.data);
        // });

        const res = await axios.get('/dokter/data')
        const data = res.data
    
        const options = data.map(d => ({
          "value" : d.ID,
          "label" : d.NAMA_GELAR
    
        }))
    
        this.setState({selectDokter: options})
    }

    async getTindakan() {
        // axios.get(`/laboratorium/data/bpjs`).then(response => {
        //     this.setState({
        //         tindakan: response.data,
        //     });
        //     // console.log(response.data);
        // });

        const res = await axios.get('/laboratorium/data/omega')
        const data = res.data
    
        const options = data.map(d => ({
          "value" : d.ID,
          "label" : d.TINDAKAN_TARIF
    
        }))
    
        this.setState({selectTarif: options})
    }

    async getStatus() {
        const options = [
            { value: 'BPJS', label: 'BPJS' },
            { value: 'UMUM', label: 'UMUM' },
          ]

          this.setState({selectStatus: options})
    }

    addTindakan() {
        this.setState({
            add_tindakan: [...this.state.add_tindakan, ""]
        });

        console.log(this.state.add_tindakan); // [1, 2, 3]

    }

    removeTindakan(i) {
        this.state.add_tindakan.splice(i,1)

        console.log(this.state.add_tindakan, "$$$$");

        this.setState({
            add_tindakan: this.state.add_tindakan
        });
    }

    totalTarifChange(e) {
        this.setState({
            hasil: e.target.value
        });
    }



    onSubmitt(e) {

        // let str =  this.state.add_tindakan + ''; //["AFP (Alpha Feto Protein) - 20000"]
        // const myArr = str.split("-");


        // console.log(myArr[1]); // [1, 2, 3]

        
        var importUserRole = this.state.add_tindakan + '';
        // arr = arr.replace(/[^0-9\.]+/g, " ");
        // let text = arr.toString();
        // text = text.replaceAll(".+-", "");
        // arr = arr.substring(arr.indexOf("-") + 1);
        // let text = arr.toString();
        // const myArr = text.split("-");
        var currentUserRole = importUserRole.split(',').map(function(user) {
            return user.split('-').pop();
          });
        console.log(currentUserRole); // [1, 2, 3]
    }

 

    onSubmit(e) {
   

        var importUserRole = this.state.add_tindakan + '';
        var currentUserRole = importUserRole.split(',').map(function(user) {
            return user.split('Rp.').pop();
          });

          currentUserRole = currentUserRole.map(Number);


        const hasil = currentUserRole.reduce(
            ( accumulator, currentValue ) => accumulator + currentValue,
            0
          );

        this.state.hasil = hasil;

        this.setState({
            hasil: this.state.hasil
        });

        console.log(this.state.hasil); // [1, 2, 3]

    }


    renderCari() {
        if (!this.state.data[0]) {
            return this.state.data.map(data => (
                <div key="1">DATA TIDAK ADA</div>
            ));
        } else {
             // console.log(this.state.selectDokter)
            return this.state.data.map(data => (
                <div key="1">
                    {/* <a
                        href={`/${data.NORM}/${this.state.awalan}/${this.state.tanggal_masuk}/label`}
                        className="btn btn-focus btn-xs"
                        target="_blank"
                    >
                        <i className="fa fa-print"></i> Cetak Kwitansi
                    </a>
                    &nbsp;
                    &nbsp;
                    <a
                        href={`/${data.NORM}/${this.state.awalan}/${this.state.tanggal_masuk}/gelang_dewasa`}
                        className="btn btn-primary btn-xs"
                        target="_blank"
                    >
                        <i className="fa fa-print"></i> Cetak Gelang Dewasa
                    </a>
                    &nbsp;
                    &nbsp;
                    <a
                        href={`/${data.NORM}/${this.state.awalan}/${this.state.tanggal_masuk}/gelang_anak`}
                        className="btn btn-danger btn-xs"
                        target="_blank"
                    >
                        <i className="fa fa-print"></i> Cetak Gelang Anak
                    </a>
                    &nbsp; */}
                    {/* <a
                        href={`/${data.NORM}/gelang_anak`}
                        className="btn btn-danger btn-xs"
                        target="_blank"
                    >
                        <i className="fa fa-print"></i> Cetak Tracer
                    </a> */}
                    &nbsp;
                    {/* <br></br>
                    <br></br> */}
                    <div className="table-responsive">
                    <table className="mb-0 table table-bordered">
                        <thead>
                            <tr>
                                <th>Rekam Medis</th>
                                <th>Tanggal</th>
                                <th>Awalan</th>
                                <th>Nama Pasien</th>
                                <th>Status</th>
                                <th>Dokter</th>
                                <th>Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td className="widthnorm">{data.NORMTITIK}</td>
                                <td className="widthtglmasuk"><input name="TANGGAL_MASUK" placeholder="Tanggal Masuk" type="date" className="form-control widthtglmasuk" required onChange={this.tanggalmasukChange} value={this.state.tanggal_masuk} /></td>
                                <td className="widthawalan"><select name="AWALAN" id="exampleSelect" className="form-control widthawalan" onChange={this.awalanChange}>
                                    <option value="%10"></option>
                                    <option value="SDR.">SDR.</option>
                                    <option value="TN.">TN.</option>
                                    <option value="NY.">NY.</option> 
                                    <option value="NN.">NN.</option>
                                    <option value="AN.">AN.</option>
                                    <option value="BY.">BY.</option>
                                    <option value="BY.NY">BY.NY</option>
                                    </select></td>
                                <td>{data.NAMA}</td>
                                <td className="widthstatus">
                                    <Select className="" name="STATUS" options={this.state.selectStatus} onChange={this.statusChange} placeholder="Pilih Status"/>
                                </td>
                                <td className="widthdokterpetugaslab">
                                <Select className="" name="DOKTER" options={this.state.selectDokter} onChange={this.namaDokterChange} placeholder="Pilih Dokter..."/>
                                </td>
                                {/* <td className=""><select name="DOKTER" id="exampleSelect" className="form-control" onChange={this.namaDokterChange} value={this.state.nama_dokter}>
                                    <option value="%10" hidden disabled>
                                        -Pilih Dokter-
                                    </option>
                                    {
                                      this.state.dokter.map((one_dokter, i) =>{
                                        return (
                                          <option key={one_dokter.ID} value={one_dokter.NAMA_GELAR}>{one_dokter.NAMA_GELAR}</option>
                                        )
                                      }) 
                                    }
                                    </select>
                                </td> */}
                                <td className="widthdokterpetugaslab">
                                <Select className="" name="PETUGAS_LAB" options={this.state.selectPetugasLab} onChange={this.namaPetugasLabChange} placeholder="Pilih Petugas..."/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                      <br></br>
                       <div>
                       <label className=""><b>Tindakan Laboratorium Omega :</b></label>  
                       
                       {
                                      this.state.add_tindakan.map((total, i) =>{
                                        return (
                                            <div key={i}>

                       <div className="form-row">
                            {/* <div className="col-md-6">
                                    <select name="TINDAKAN" id="exampleSelect" className="form-control" onChange={(e) => this.tindakanChange(e, i)}>
                                    <option value="" hidden disabled>
                                        -Pilih Tindakan-
                                    </option>
                                    <option hidden>-Pilih Tindakan-</option>
                                    {
                                      this.state.tindakan.map((one_tindakan, i) =>{
                                        return (
                                          <option key={i} value={one_tindakan.NAMA}>{one_tindakan.NAMA}</option>
                                        )
                                      }) 
                                    }
                                    </select>
                            </div> */}
                            <div className="col-md-4">
                                 <Select className="" name="TARIF" options={this.state.selectTarif} onChange={(e) => this.tarifChange(e, i)} placeholder="Pilih Tindakan..."/>
                                    {/* <select name="TARIF" id="exampleSelect" className="form-control" onChange={(e) => this.tarifChange(e, i)}>
        
                                    <option hidden>-Pilih Tindakan-</option>
                                    {
                                      this.state.tindakan.map((one_tarif, i) =>{
                                        return (
                                          <option key={i} value={one_tarif.NAMA+" - "+"Rp. "+one_tarif.TARIF}>{one_tarif.TINDAKAN_TARIF}</option>
                                        )
                                      }) 
                                    }
                                    </select> */}
                            </div>
                            <div className="col-md-8">
                                    <button
                                        className="btn btn-danger btn-xs"
                                        onClick={()=>this.removeTindakan(i)}
                                    >
                                        <i className="fa fa-trash"></i>
                                    </button>
                            </div>        
                        </div>
                        <br />

                        </div>
                            )
                         }) 
                         
                         }

                            <div>
                                    <button
                                        className="btn btn-primary btn-xs"
                                        onClick={(e)=>this.addTindakan(e)}
                                    >
                                        <i className="fa fa-plus"></i> Tindakan
                                    </button>
                            </div> 

                                    {/* <div className="form-row">
                                                <div className="col-md-6">
                                                    <div className="position-relative form-group"><label htmlFor="exampleEmail11" className="">Email</label><input name="email" id="exampleEmail11" placeholder="with a placeholder" type="email" className="form-control" /></div>
                                                </div>
                                                <div className="col-md-6">
                                                    <div className="position-relative form-group"><label htmlFor="examplePassword11" className="">Password</label><input name="password" id="examplePassword11" placeholder="password placeholder" type="password"
                                                                                                                                                             className="form-control" /></div>
                                                </div>
                                    </div> */}

                              
                                    <br></br>
                                    <br></br>
                                    <label className=""><b>Total Harga :</b></label>  
                                    <div>
                                       <b>Rp.</b>
                                    </div> 
                                    <div className="form-row">
                                       <div className="col-md-2">
                                       <input disabled name="TOTAL_TARIF" placeholder="Total Harga" type="number" className="form-control" onChange={this.totalTarifChange} value={this.state.hasil} />
                                       </div>
                                       <div className="col-md-10">
                                       <button
                                       className="btn btn-success btn-xs"
                                       onClick={(e)=>this.onSubmit(e)}
                                       >
                                       <i className="fa fa-fw" aria-hidden="true" title="Copy to use dollar"></i>Total Harga
                                       </button>
                                       </div>
                                    </div>
                                    <br></br>
                  
                                   <br></br>
                                    <a
                                        href={`/${data.NORM}/${this.state.awalan}/${this.state.tanggal_masuk}/${this.state.status}/${this.state.nama_dokter}/${this.state.nama_petugas_lab}/${this.state.add_tindakan}/${this.state.hasil}/Laboratorium`}
                                        // href={`print_laboratorium`}
                                        className="btn btn-focus btn-xs"
                                        target="_blank"
                                    >
                                        <i className="fa fa-print"></i> Cetak Kwitansi
                                    </a>
                                    <br></br>
                                    <br></br>
                                
                       </div>
                  </div>
                </div>
            ));
        }
    }

    componentDidMount() {
        this.getTodayDate();
        this.getDokter();
        this.getTindakan();
        this.getPetugasLab();
        this.getStatus();
    }

    componentDidUpdate() {
    }

    render() {
        return (
            <div>
                <div className="app-page-title">
                    <div className="page-title-wrapper">
                        <div className="page-title-heading">
                            <div className="page-title-icon">
                                <i className="pe-7s-drop icon-gradient bg-arielle-smile"></i>
                            </div>
                            <div>
                                Laboratorium Omega
                                <div className="page-title-subheading">
                                    Halaman ini berfungsi untuk mencetak Tindakan
                                    Pasien Laboratorium <b>Omega.</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="main-card mb-3 card">
                    <div className="card-body">
                        <form onSubmit={this.handleSubmit}>
                            <div className="form-group">
                                <input
                                    onChange={this.handleChange}
                                    value={this.state.cari}
                                    className="form-control-lg form-control"
                                    placeholder="Cari Nomor Rekam Medis"
                                    required
                                />
                            </div>
                            <button
                                type="submit"
                                className="btn-square btn-hover-shine btn btn-info"
                            >
                                <a className="pe-7s-search"></a> CARI / KLIK
                                ENTER UNTUK CARI
                            </button>
                        </form>
                        <hr />
                        <p></p>
                        {this.renderCari()}
                    </div>
                </div>
            </div>
        );
    }
}

export default LabOmega;
