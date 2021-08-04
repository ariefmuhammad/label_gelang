import React, { Component } from "react";

class Lab extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            dokter: [],
            tindakan: [],
            cari: "",
            awalan: "%10",
            tanggal_masuk: "",
            status: "",
            nama_dokter: "",
            // tarif: "",
            input_dokter: "",
            nama_tindakan: [],
            add_tindakan: [],
            // tarif: [],
            hasil: "",
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.renderCari = this.renderCari.bind(this);
        this.awalanChange = this.awalanChange.bind(this);
        this.tanggalmasukChange = this.tanggalmasukChange.bind(this);
        this.statusChange = this.statusChange.bind(this);
        this.namaDokterChange = this.namaDokterChange.bind(this);
        this.tindakanChange = this.tindakanChange.bind(this);
        this.tarifChange = this.tarifChange.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
        this.totalTarifChange = this.totalTarifChange.bind(this);
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
        this.setState({
            status: e.target.value
        });
    }

    handleChange(e) {
        this.setState({
            cari: e.target.value
        });
        // console.log(e.target.value);
    }

    tindakanChange(e, i) {
        this.state.nama_tindakan[i] = e.target.value
        this.setState({
            nama_tindakan: this.state.nama_tindakan
        });
    }

    tarifChange(e, i) {
        this.state.add_tindakan[i] = e.target.value
        this.setState({
            add_tindakan: this.state.add_tindakan
        });

        // this.setState({
        //     tarif: e.target.value
        // });
    }

    namaDokterChange(e) {
        this.setState({
            nama_dokter: e.target.value
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

    getDokter() {
        axios.get(`/dokter/data`).then(response => {
            this.setState({
                dokter: response.data,
            });
            // console.log(response.data);
        });
    }

    getTindakan() {
        axios.get(`/laboratorium/data`).then(response => {
            this.setState({
                tindakan: response.data,
            });
            // console.log(response.data);
        });
    }

    addTindakan() {
        this.setState({
            add_tindakan: [...this.state.add_tindakan, ""]
        });
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

    onSubmit(e) {
   

        var arr = this.state.add_tindakan;
        arr = arr.map(Number);


        const hasil = arr.reduce(
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
                                <td className=""><select name="STATUS" id="exampleSelect" className="form-control" onChange={this.statusChange} value={this.state.status}>
                                    <option value="" hidden disabled>
                                        -Pilih Status-
                                    </option>
                                    <option value="BPJS I">BPJS I</option>
                                    <option value="BPJS II">BPJS II</option> 
                                    <option value="BPJS III">BPJS III</option>
                                    <option value="UMUM">UMUM</option>
                                    </select>
                                </td>
                                <td className=""><select name="DOKTER" id="exampleSelect" className="form-control" onChange={this.namaDokterChange} value={this.state.nama_dokter}>
                                    <option value="" hidden disabled>
                                        -Pilih Dokter-
                                    </option>
                                    {
                                      this.state.dokter.map((one_dokter, i) =>{
                                        return (
                                          <option key={one_dokter.ID} value={one_dokter.NAMA}>{one_dokter.NAMA}</option>
                                        )
                                      }) 
                                    }
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                      <br></br>
                       <div>
                       <label className=""><b>Tindakan Laboratorium :</b></label>  
                       
                       {
                                      this.state.add_tindakan.map((total, i) =>{
                                        return (
                                            <div key={i}>

                       <div className="form-row">
                            <div className="col-md-6">
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
                            </div>
                            <div className="col-md-5">
                                    <select name="TARIF" id="exampleSelect" className="form-control" onChange={(e) => this.tarifChange(e, i)}>
                                    <option value="" hidden disabled>
                                        -Pilih Tarif-
                                    </option>
                                    <option hidden>-Pilih Tarif-</option>
                                    {
                                      this.state.tindakan.map((one_tindakan, i) =>{
                                        return (
                                          <option key={i} value={one_tindakan.TARIF}>Rp. {one_tindakan.TARIF}</option>
                                        )
                                      }) 
                                    }
                                    </select>
                            </div>
                            <div className="col-md-1">
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
                                    <div className="form-row">
                                       <div className="col-md-4">
                                       <input name="TOTAL_TARIF" placeholder="Total Harga" type="number" className="form-control" onChange={this.totalTarifChange} value={this.state.hasil} />
                                       </div>
                                       <div className="col-md-8">
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
                                        href={`/${data.NORM}/${this.state.awalan}/${this.state.tanggal_masuk}/${this.state.status}/${this.state.nama_dokter}/${this.state.nama_tindakan}/${this.state.add_tindakan}/${this.state.hasil}/Laboratorium`}
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
                                Laboratorium
                                <div className="page-title-subheading">
                                    Halaman ini berfungsi untuk mencetak Tindakan
                                    Pasien Laboratorium.
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

export default Lab;
