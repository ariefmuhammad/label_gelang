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
            // tarif: "",
            input_dokter: "",
            add_tindakan: [],
            tarif: [],
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.renderCari = this.renderCari.bind(this);
        this.awalanChange = this.awalanChange.bind(this);
        this.tanggalmasukChange = this.tanggalmasukChange.bind(this);
        this.statusChange = this.statusChange.bind(this);
        this.tarifChange = this.tarifChange.bind(this);
        this.inputDokterChange = this.inputDokterChange.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
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

    tarifChange(e, i) {
        this.state.add_tindakan[i] = e.target.value
        this.setState({
            add_tindakan: this.state.add_tindakan
        });

        // this.setState({
        //     tarif: e.target.value
        // });
    }

    inputDokterChange(e) {
        this.setState({
            input_dokter: e.target.value
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
        axios.get(`/dokter`).then(response => {
            this.setState({
                dokter: response.data,
            });
            // console.log(response.data);
        });
    }

    getTindakan() {
        axios.get(`/lab`).then(response => {
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

    onSubmit(e) {
        console.log(this.state.add_tindakan, "$$$$");
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
                                <td className="widthawalan"><select name="STATUS" id="exampleSelect" className="form-control widthawalan" onChange={this.statusChange}>
                                    <option value="%10"></option>
                                    <option value="BPJS">BPJS</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option> 
                                    <option value="III">III</option>
                                    <option value="UMUM">UMUM</option>
                                    </select>
                                </td>
                                <td className=""><select name="DOKTER" id="exampleSelect" className="form-control" onChange={this.inputDokterChange} value={this.state.input_dokter}>
                                    <option value="" hidden disabled>
                                        -Pilih Dokter-
                                    </option>
                                    <option value="%10"></option>
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
                       <label className="">Tindakan Laboratorium :</label>  
                       
                       {
                                      this.state.add_tindakan.map((i) =>{
                                        return (
                                            <div key={i}>

                       <div className="form-row">
                            <div className="col-md-11">
                                    <select name="TINDAKAN" id="exampleSelect" className="form-control" onChange={this.tarifChange}>
                                    <option value="" hidden disabled>
                                        -Pilih Tindakan-
                                    </option>
                                    <option hidden>-Pilih Tindakan-</option>
                                    {
                                      this.state.tindakan.map((one_tindakan, i) =>{
                                        return (
                                          <option key={one_tindakan.ID} value={one_tindakan.TARIF}>{one_tindakan.NAMA} - Rp. {one_tindakan.TARIF}</option>
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
                                    <br></br>
                                    <label className="">Total Harga :</label>   
                                    <input name="" placeholder="Total Harga" type="number" className="form-control" onChange={this.tarifChange} value={this.state.tarif} />
                                    <br></br>
                                    <a
                                        href={`/${data.NORM}/${this.state.awalan}/${this.state.tanggal_masuk}/label`}
                                        className="btn btn-focus btn-xs"
                                        target="_blank"
                                    >
                                        <i className="fa fa-print"></i> Cetak Kwitansi
                                    </a>

                                    <button
                                       
                                        className="btn btn-warning btn-xs"
                                        onClick={(e)=>this.onSubmit(e)}
                                    >
                                        <i className="fa fa-print"></i> Submit
                                    </button>
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
