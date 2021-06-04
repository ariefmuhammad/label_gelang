import React, { Component } from "react";

class Lab extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            cari: "",
            awalan: "%10",
            tanggal_masuk: ""
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.renderCari = this.renderCari.bind(this);
        this.awalanChange = this.awalanChange.bind(this);
        this.tanggalmasukChange = this.tanggalmasukChange.bind(this);
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

    dokterChange(e) {
        this.setState({
            dokter: e.target.value
        });
    }

    handleChange(e) {
        this.setState({
            cari: e.target.value
        });
        // console.log(e.target.value);
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

    renderCari() {
        if (!this.state.data[0]) {
            return this.state.data.map(data => (
                <div key="1">DATA TIDAK ADA</div>
            ));
        } else {
            return this.state.data.map(data => (
                <div key="1">
                    <a
                        href={`/${data.NORM}/${this.state.awalan}/${this.state.tanggal_masuk}/label`}
                        className="btn btn-focus btn-xs"
                        target="_blank"
                    >
                        <i className="fa fa-print"></i> Cetak Label
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
                    &nbsp;
                    {/* <a
                        href={`/${data.NORM}/gelang_anak`}
                        className="btn btn-danger btn-xs"
                        target="_blank"
                    >
                        <i className="fa fa-print"></i> Cetak Tracer
                    </a> */}
                    &nbsp;
                    <br></br>
                    <br></br>
                    <div className="table-responsive">
                    <table className="mb-0 table table-bordered">
                        <thead>
                            <tr>
                                <th>Rekam Medis</th>
                                <th>Tanggal Masuk</th>
                                <th>Awalan</th>
                                <th>Nama Pasien</th>
                                <th>Status</th>
                                <th>Dokter</th>
                                <th>Jenis Kelamin</th>                     
                                <th>Tanggal Lahir</th>
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
                                <td className="widthawalan"><select name="STATUS" id="exampleSelect" className="form-control widthawalan" onChange={this.awalanChange}>
                                    <option value="%10"></option>
                                    <option value="BPJS">BPJS</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option> 
                                    <option value="III">III</option>
                                    <option value="UMUM">UMUM</option>
                                    </select>
                                </td>
                                <td className="widthawalan"><select name="DOKTER" id="exampleSelect" className="form-control widthawalan" onChange={this.awalanChange}>
                                    <option value="%10"></option>
                                    <option value="wiwik">wiwik</option>
                                    <option value="agus">agus</option>
                                    </select>
                                </td>
                                <td className="widthjkp">{data.JENIS_KELAMIN === 1 ? "Laki-Laki" : "Perempuan"}</td>
                                <td className="widthlahir">{data.TANGGAL_LAHIR}</td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            ));
        }
    }

    componentDidMount() {
        this.getTodayDate();
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
                                <i className="pe-7s-print icon-gradient bg-arielle-smile"></i>
                            </div>
                            <div>
                                Pasien Lab
                                <div className="page-title-subheading">
                                    Halaman ini berfungsi untuk mencetak Tindakan
                                    Pasien Lab.
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
