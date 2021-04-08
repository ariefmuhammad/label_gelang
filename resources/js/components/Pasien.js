import React, { Component } from "react";


class Pasien extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            url: "/pasien/data",
            tujuan: "101010101",
            awalan: "%10",
            tanggal_masuk: ""
        };
        this.handleChange = this.handleChange.bind(this);
        this.renderCari = this.renderCari.bind(this);
        this.getData = this.getData.bind(this);
        this.awalanChange = this.awalanChange.bind(this);
        this.tanggalmasukChange = this.tanggalmasukChange.bind(this);
    }

    getTodayDate() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = "0" + dd;
        }
        if (mm < 10) {
            mm = "0" + mm;
        }
        var terbalik = yyyy + "-" + mm + "-" + dd;
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

    handleChange(e) {
        this.setState({
            tujuan: e.target.value
        });
        // console.log(e.target.value);
        if (e.target.value == "101020101") {
            axios.get(`/pasien/data/ugd/${e.target.value}`).then(response => {
                this.setState({
                    data: response.data.cari
                });
                // console.log(response.data.cari.pasien);
            });
        } else {
            axios.get(`/pasien/data/${e.target.value}`).then(response => {
                this.setState({
                    data: response.data.cari
                });
                // console.log(response.data.cari.pasien);
            });
        }
    }

    getData() {
        axios.get(`/pasien/data/${this.state.tujuan}`).then(response => {
            this.setState({
                data: response.data.cari,
                tanggal_masuk: this.getTodayDate(),
                awalan: "%10",
                peminjam: "%10"
            });
            // console.log(response.data.cari.pasien);
        });
    }



    renderCari() {
        if (this.state.tujuan === "101020101") {
            return (
                <table className="mb-0 table table-bordered">
                    <thead>
                        <tr>
                            <th>No Urut</th>
                            <th>Tanggal Masuk</th>
                            <th>Awalan</th>
                            <th>Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>JK</th>
                            <th>Tanggal Lahir</th>
                            <th>Cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                        {this.state.data.map(data => (
                            <tr key={data[0].nomor}>
                                <td className="widthnodaftarp">{data[0].nomor}</td>
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
                                <td className="widthnormp">
                                    {data[0].NORMTITIK}
                                </td>
                                <td>{data[0].NAMA}</td>
                                <td className="widthjkp">
                                    {data[0].JENIS_KELAMIN === 1
                                        ? "Laki-Laki"
                                        : "Perempuan"}
                                </td>
                                <td className="widthlahirp">
                                    {data[0].TANGGAL_LAHIR}
                                </td>
                                <td className="widthcetak">
                                      
                                       <a
                                           onSubmit={this.handleSubmit}
                                           // href={`/tracer/${data.NORM}/print`}
                                           href=""
                                           className="btn btn-primary btn-xs"
                                           target="_blank"
                                       >
                                           <i className="fa fa-print"></i> Print Label
                                       </a>
                                       &nbsp;
                                       <a
                                           onSubmit={this.handleSubmit}
                                           // href={`/tracer/${data.NORM}/print`}
                                           href=""
                                           className="btn btn-success btn-xs"
                                           target="_blank"
                                       >
                                           <i className="fa fa-print"></i> Print Gelang
                                       </a>
                                       &nbsp;
                                       <a
                                           onSubmit={this.handleSubmit}
                                        //    href={`/tracer/${data.NORM}/print`}
                                           href={`/${data[0].NORM}/${this.state.awalan}/${this.state.tanggal_masuk}/${this.state.peminjam}/tracer`}
                                           className="btn btn-alternate btn-xs"
                                           target="_blank"
                                       >
                                           <i className="fa fa-print"></i> Print Tracer
                                       </a>
                                       &nbsp;

                                       <div className="dropdown d-inline-block">
                                            <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" className="mb-2 mr-2 dropdown-toggle btn btn-primary">Primary</button>
                                            <div tabIndex="-1" role="menu" aria-hidden="true" className="dropdown-menu">
                                                <button type="button" tabIndex="0" className="dropdown-item">Menus</button>
                                                <button type="button" tabIndex="0" className="dropdown-item">Settings</button>
                                                <h6 tabIndex="-1" className="dropdown-header">Header</h6>
                                                <button type="button" tabIndex="0" className="dropdown-item">Actions</button>
                                                <div tabIndex="-1" className="dropdown-divider"></div>
                                                <button type="button" className="0" className="dropdown-item">Dividers</button>
                                            </div>
                                        </div>                       

                                    </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            );
        } else {
            return this.state.data.map((post, i) => (
                <div key={`Key${i}`} className="margintop30">
                    <table className="mb-0 table table-bordered">
                        <thead>
                            <tr>
                            <th colSpan="8" className="bg-happy-green"><center><h5><b className="text-light">{post[0].nama_dokter}</b></h5></center></th>
                            </tr>
                            <tr>
                                <th>No Urut</th>
                                <th>Tanggal Masuk</th>
                                <th>Awalan</th>
                                <th>Rekam Medis</th>
                                <th>Nama Pasien</th>
                                <th>JK</th>
                                <th>Tanggal Lahir</th>
                                <th>Cetak</th>
                            </tr>
                        </thead>
                        <tbody>
                            {post.map((detail, j) => {
                                 if(detail['NORM'] == "")
                                 return (
                                    <tr key={`Key${j}`}>
                                     <td colSpan="8"><center><b>Belum Ada Pasien</b></center></td>
                                    </tr>
                                 );
                                 else
                                 return (
                                <tr key={`Key${j}`}>
                                    <td className="widthnodaftar">{detail.nomor}</td>
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
                                    <td className="widthnorm">{detail.NORM}</td>
                                    <td>{detail.NAMA}</td>
                                    <td className="widthjk">
                                        {detail.JENIS_KELAMIN === 1
                                            ? "L"
                                            : detail.JENIS_KELAMIN === 2
                                            ? "P"
                                            : ""}
                                    </td>
                                    <td className="widthlahir">{detail.TANGGAL_LAHIR}</td>
                                    <td className="">
                                       <div>
                                       <a
                                        //    onSubmit={this.handleSubmit}
                                           // href={`/tracer/${data.NORM}/print`}
                                           href=""
                                           className="btn btn-primary btn-sm"
                                           target="_blank"
                                       >
                                           <i className="fa fa-print"></i> Label
                                       </a>
                                       </div>
                                       &nbsp;
                                       <div>
                                       <a
                                        //    onSubmit={this.handleSubmit}
                                           // href={`/tracer/${data.NORM}/print`}
                                           href=""
                                           className="btn btn-success btn-sm"
                                           target="_blank"
                                       >
                                           <i className="fa fa-print"></i> Gelang Dewasa
                                       </a>
                                       </div>
                                       &nbsp;
                                       <div>
                                       <a
                                        //    onSubmit={this.handleSubmit}
                                           // href={`/tracer/${data.NORM}/print`}
                                           href=""
                                           className="btn btn-danger btn-sm"
                                           target="_blank"
                                       >
                                           <i className="fa fa-print"></i> Gelang Anak
                                       </a>
                                       </div>
                                       &nbsp;
                                       <div>
                                       <a
                                        //    onSubmit={this.handleSubmit}
                                        //    href={`/tracer/${data.NORM}/print`}
                                           href={`/${detail.NORM}/${this.state.awalan}/${this.state.tanggal_masuk}/${this.state.peminjam}/tracer`}
                                           className="btn btn-alternate btn-sm"
                                           target="_blank"
                                       >
                                           <i className="fa fa-print"></i> Tracer
                                       </a>
                                       </div>
                                       &nbsp;

                                       {/* <div className="dropdown d-inline-block">
                                            <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" className="mb-2 mr-2 dropdown-toggle btn btn-primary">Primary</button>
                                            <div tabIndex="-1" role="menu" aria-hidden="true" className="dropdown-menu">
                                                <button type="button" tabIndex="0" className="dropdown-item">Menus</button>
                                                <button type="button" tabIndex="0" className="dropdown-item">Settings</button>
                                                <h6 tabIndex="-1" className="dropdown-header">Header</h6>
                                                <button type="button" tabIndex="0" className="dropdown-item">Actions</button>
                                                <div tabIndex="-1" className="dropdown-divider"></div>
                                                <button type="button" className="0" className="dropdown-item">Dividers</button>
                                            </div>
                                        </div>                        */}

                                    </td>
                                </tr>
                                );
                            })}
                        </tbody>
                    </table>
                </div>
            ));
        }
    }

    componentDidMount() {
        this.getData();
    }

    componentDidUpdate() {}

    render() {
        // console.log(this.state.data);
        return (
            <div>
                <div className="app-page-title">
                    <div className="page-title-wrapper">
                        <div className="page-title-heading">
                            <div className="page-title-icon">
                                <i className="pe-7s-note2 icon-gradient bg-happy-green"></i>
                            </div>
                            <div>
                                PASIEN HARI INI
                                <div className="page-title-subheading">
                                    Halaman ini berfungsi untuk melihat Pasien
                                    Hari Ini.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="main-card mb-3 card">
                    <div className="card-body">
                        <form onSubmit={this.handleSubmit}>
                            <div className="form-group">
                                <div>
                                    <span className="parents-line">
                                        <h5><b>Tujuan :</b></h5>
                                    </span>
                                    <p></p>
                                    <select
                                        className="form-control parents"
                                        onChange={this.handleChange}
                                        value={this.state.tujuan}
                                    >
                                        <option value="101010101">
                                            Poli Anak
                                        </option>
                                        <option value="101010102">
                                            Poli Bedah
                                        </option>
                                        {/* <option value="101010103">
                                            Poli Gigi Anak
                                        </option> */}
                                        <option value="101010104">
                                            Poli Gigi Umum
                                        </option>
                                        <option value="101010105">
                                            Poli Mata
                                        </option>
                                        <option value="101010106">
                                            Poli Neurologi/Syaraf
                                        </option>
                                        <option value="101010107">
                                            Poli Obgyn/Kandungan
                                        </option>
                                        <option value="101010108">
                                            Poli Penyakit Dalam
                                        </option>
                                        <option value="101010109">
                                            Poli THT
                                        </option>
                                        <option value="101010110">
                                            Poli Bedah Syaraf
                                        </option>
                                        <option value="101010111">
                                            Poli Forensik
                                        </option>
                                        <option value="101010112">
                                            Poli Rehabilitas Medik
                                        </option>
                                        <option value="101010114">
                                            Poli Hemodialisa
                                        </option>
                                        <option value="101020101">IGD</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <p></p>
                        <hr />
                        <p></p>
                        <div className="table-responsive">
                            {this.renderCari()}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Pasien;
