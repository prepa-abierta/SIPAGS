<template>
<div class="container">
    <form-wizard @on-complete="onComplete" @on-loading="setLoading" @on-validate="handleValidation" @on-error="handleErrorMessage" shape="tab" back-button-text="Anterior!" next-button-text="Siguiente!" error-color="#e74c3c">
        <h2 slot="title">Pre-Registro</h2>
        <tab-content title="Aviso de privacidad" :before-change="validarTerminos" icon="fas fa-book">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" ref="terminos" id="terminos">
                <label for="terminos">Acepto terminos y condiciones</label>
            </div>
        </tab-content>

        <tab-content title="CURP" :before-change="validarCurp" icon="fas fa-cog">
            <div class="form-group">
                <label for="curp">CURP</label>
                <input type="text" ref="curp" class="form-control" id="curp" value="ROSL960503HSLSLS05" placeholder="BADD110313HCMLNS09" maxlength="18" min="18" required>
            </div>
            <div class="form-group">
              <a href="https://www.gob.mx/curp/" class="btn btn-primary btn-md active" role="button" aria-pressed="true" target="_blank">Consulta CURP</a>
            </div>
    </tab-content>

        <tab-content title="Datos Personales" :before-change="validarCampos" icon="fas fa-user">

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" :class="{'is-invalid': errors.Nombre}" v-model="curps.Nombre" id="nombre" disabled>
                    <div class="invalid-feedback" v-if="errors.Nombre">{{errors.Nombre[0]}}</div>
                </div>
                <div class="form-group col-md-4">
                    <label for="apellidoP">Apellido Paterno</label>
                    <input type="text" class="form-control" :class="{'is-invalid': errors.Primer_Apellido}" v-model="curps.Primer_Apellido" id="apellidoP" disabled>
                    <div class="invalid-feedback" v-if="errors.Primer_Apellido">{{errors.Primer_Apellido[0]}}</div>
                </div>
                <div class="form-group col-md-4">
                    <label for="apellidoM">Apellido Materno</label>
                    <input type="text" class="form-control" :class="{'is-invalid': errors.Segundo_Apellido}" v-model="curps.Segundo_Apellido" id="apellidoM" disabled>
                    <div class="invalid-feedback" v-if="errors.Segundo_Apellido">{{errors.Segundo_Apellido[0]}}</div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="sexo">Sexo</label>
                    <input type="text" class="form-control" :class="{'is-invalid': errors.sexo}" v-model="curps.sexo" id="sexo" disabled>
                    <div class="invalid-feedback" v-if="errors.sexo">{{errors.sexo[0]}}</div>
                </div>
                <div class="form-group col-md-4">
                    <label for="nacionalidad">Nacionalidad</label>
                    <input type="text" class="form-control" :class="{'is-invalid': errors.Nacionalidads}" v-model="curps.Nacionalidads" id="nacionalidad" disabled>
                    <div class="invalid-feedback" v-if="errors.Nacionalidads">{{errors.Nacionalidads[0]}}</div>
                </div>
                <div class="form-group col-md-4">
                    <label for="fechaN">Fecha de Nacimiento</label>
                    <input type="text" class="form-control" :class="{'is-invalid': errors.Fecha_Nacimiento}" v-model="curps.Fecha_Nacimiento" id="fechaN" disabled>
                    <div class="invalid-feedback" v-if="errors.Fecha_Nacimiento">{{errors.Fecha_Nacimiento[0]}}</div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="paisN">Pais de Nacimiento</label>
                    <input type="text" class="form-control" :class="{'is-invalid': errors.PaisNacimiento}" v-model="curps.PaisNacimiento" id="paisN" disabled>
                    <div class="invalid-feedback" v-if="errors.PaisNacimiento">{{errors.PaisNacimiento[0]}}</div>
                </div>
                <div class="form-group col-md-4">
                    <label for="estadoN">Estado de Nacimiento</label>
                    <input type="text" class="form-control" :class="{'is-invalid': errors.Estado}" v-model="curps.Estado" id="estadoN" disabled>
                    <div class="invalid-feedback" v-if="errors.Estado">{{errors.Estado[0]}}</div>
                </div>
                <div class="form-group col-md-4">
                    <label for="lugarN"> Lugar de Nacimiento</label>
                    <input type="text" class="form-control" :class="{'is-invalid': errors.Lugar}" v-model="curps.Lugar" id="lugarN" disabled>
                    <div class="invalid-feedback" v-if="errors.Lugar">{{errors.Lugar[0]}}</div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="correoE">Correo</label>
                    <input type="email" v-model="curps.Correo" :class="{'is-invalid': errors.Correo}" class="form-control" id="correoE" ref="correo" placeholder="Correo">
                    <div class="invalid-feedback" v-if="errors.Correo">{{errors.Correo[0]}}</div>
                </div>
                <div class="form-group col-md-4">
                    <label for="telefonoF">Teléfono Fijo</label>
                    <input type="text" v-model="curps.Telefono" :class="{'is-invalid': errors.Telefono}" class="form-control" id="telefonoF" ref="telefono" maxlength="10" min="10" placeholder="Teléfono">
                    <div class="invalid-feedback" v-if="errors.Telefono">{{errors.Telefono[0]}}</div>
                </div>
                <div class="form-group col-md-4">
                    <label for="celular">Celular</label>
                    <input type="text" v-model="curps.Celular" :class="{'is-invalid': errors.Celular}" class="form-control" id="celular" ref="celular" maxlength="10" min="10" placeholder="Celular">
                    <div class="invalid-feedback" v-if="errors.Celular">{{errors.Celular[0]}}</div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="checkbox" v-model="checked">
                        <label class="custom-control-label" for="checkbox">Seleccionar Si Tiene Algúna Discapacidad</label>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <button v-on:click="guardarProceso('1')"class="btn btn-primary float-right">Guardar Proceso</button>
                </div>
            </div>
            <div v-if="checked" class="form-row">
                <div class="form-group col-md-4">
                  <label for="discapacidad">Discapacidad</label>
                  <select class="form-control" :class="{'is-invalid': errors.discapacidad_id}" v-model="curps.discapacidad_id">
                    <option v-for="(discapacidad, key) in discapacidades" :value="discapacidad.id">{{discapacidad.Discapacidad_Dsc}}</option>
                  </select>
                  <div class="invalid-feedback" v-if="errors.discapacidad_id">{{errors.discapacidad_id[0]}}</div>
                </div>
            </div>
        </tab-content>

        <tab-content title="Datos Escolares" :before-change="validarEscolar" icon="fas fa-user-graduate">
            <!-- curps.Estado == 'Guanajuato' -->
            <div class="form-row">
                <!-- Poblacion, Estado, Nombre_Escuela, Ultimo_grado, Clave_Escuela, Nivel -> Secundaria, Prepa se activa el último grado  -->
                <div class="form-group col-md-4">
                    <label for="nivelE">Nivel de Escolaridad</label>
                    <select class="form-control" :class="{'is-invalid': errors.Nivel_Escolaridad}" v-model="curps.Nivel_Escolaridad">
                      <option v-for="(nivel) in nivelE" :value="nivel">{{ nivel }}</option>
                    </select>
                    <!-- <cool-select v-model="curps.Nivel_Escolaridad" :items="nivelE" :error-message="nivels_E" placeholder="Seleccionar Nivel Escolar" /> -->
                    <div class="invalid-feedback" v-if="errors.Nivel_Escolaridad">{{errors.Nivel_Escolaridad[0]}}</div>

                </div>
                <div class="form-group col-md-4">
                    <label for="escuelaP">Escuela de Procedencia</label>
                    <input type="text" class="form-control" :class="{'is-invalid': errors.Escuela_Procedencia}" v-model="curps.Escuela_Procedencia" id="escuelaP" placeholder="Escuela de Procedencia">
                    <div class="invalid-feedback" v-if="errors.Escuela_Procedencia">{{errors.Escuela_Procedencia[0]}}</div>
                </div>
                <div class="form-group col-md-4">
                    <label for="claveUS">Clave de Último Grado</label>
                    <input type="text" class="form-control" :class="{'is-invalid': errors.Clave_Ultimo_Grado}" v-model="curps.Clave_Ultimo_Grado" id="claveUS" placeholder="Clave de Último Grado">
                    <div class="invalid-feedback" v-if="errors.Clave_Ultimo_Grado">{{errors.Clave_Ultimo_Grado[0]}}</div>
                </div>

            </div>

            <!-- select Nivel_Escolaridad secundaria prepa
          Nombre de Escuela Nombre_Escuela
          Ultimo_Grado
          Anio_Egreso
          Numero_Certificado
          Pais
          Estado
          Municipio
          Folio_Surems -->

            <div class="form-row">
                <!-- Poblacion, Estado, Nombre_Escuela, Ultimo_grado, Clave_Escuela, Nivel -> Secundaria, Prepa se activa el último grado  -->

                <div class="form-group col-md-3">
                    <label for="anioE">Año de Egreso</label>
                    <select class="form-control" :class="{'is-invalid': errors.Anio_Egreso}" v-model="curps.Anio_Egreso">
                      <option v-for="year in getCurrentYear()" v-if="year >= 1950" :value="year">{{ year }}</option>
                    </select>
                    <!-- <input type="date" data-date-format="yyyy" class="date-own form-control" :class="{'is-invalid': errors.Anio_Egreso}" v-model="curps.Anio_Egreso" id="anioE" placeholder="Año de Egreso"> -->
                    <div class="invalid-feedback" v-if="errors.Anio_Egreso">{{errors.Anio_Egreso[0]}}</div>
                </div>
                <div class="form-group col-md-9">
                    <label for="numeroC">Número de Certificado</label>
                    <input type="text" class="form-control" :class="{'is-invalid': errors.Numero_Certificado}" v-model="curps.Numero_Certificado" id="numeroC" placeholder="Número de Certificado">
                    <div class="invalid-feedback" v-if="errors.Numero_Certificado">{{errors.Numero_Certificado[0]}}</div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="epais">País</label>
                    <select class="form-control" :class="{'is-invalid': errors.pais_id}" v-model="curps.pais_id">
                      <option v-for="(pais, key) in paises" :value="pais.id">{{pais.Pais_Dsc}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.pais_id">{{errors.pais_id[0]}}</div>

                </div>
                <div  v-if="this.curps.pais_id==4142"class="form-group col-md-4">
                    <label for="eestado">Estado</label>
                    <select class="form-control" :class="{'is-invalid': errors.estado_id}" v-on:change="getMunicipios()" v-model="curps.estado_id">
                      <option v-for="(estado, key) in estados" :value="estado.id">{{estado.Entidad_Dsc}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.estado_id">{{errors.estado_id[0]}}</div>
                </div>
                <div v-if="this.curps.pais_id==4142" class="form-group col-md-4">
                    <label for="emunicipio">Municipio</label>
                    <select class="form-control" :class="{'is-invalid': errors.municipio_id}" v-model="curps.municipio_id">
                      <option v-for="(municipio, key) in municipios" :value="municipio.id">{{municipio.Poblacion_Dsc}}</option>
                    </select>
                    <div class="invalid-feedback" v-if="errors.municipio_id">{{errors.municipio_id[0]}}</div>
                </div>
            </div>
            <div v-if="curps.Edad<18" class="form-row">
                <div class="form-group col-md-4">
                    <label for="folioSurem">Folio Surem</label>
                    <input type="text" class="form-control" :class="{'is-invalid': errors.Folio_Surems}" v-model="curps.Folio_Surems" id="folioSurem">
                    <div class="invalid-feedback" v-if="errors.Folio_Surems">{{errors.Folio_Surems[0]}}</div>
                    <div class="form-group">
                      <a href="http://surems.seg.guanajuato.gob.mx/Account/Login" class="btn btn-primary btn-md active" role="button" aria-pressed="true" target="_blank">Consulta Folio SUREMS</a>
                    </div>
                </div>

                <div class="form-group col-md-8">
                    <button v-on:click="guardarProceso('3')"class="btn btn-primary float-right">Guardar Proceso</button>
                </div>

            </div>
            <div v-else class="form-row">
              <div class="form-group col-md-12">
                  <button v-on:click="guardarProceso('3')"class="btn btn-primary float-right">Guardar Proceso</button>
              </div>
            </div>
        </tab-content>

        <tab-content title="Domicilio" :before-change="validarDomicilio" icon="fas fa-home">

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="codigoP">Código Postal</label>
                    <input type="text" :class="{'is-invalid': errors.Codigo_Postal}" v-model="curps.Codigo_Postal" v-on:change="getCodigo()" class="form-control" id="codigoP" ref="codigo" maxlength="5" min="5" placeholder="Código Postal">
                    <div class="invalid-feedback" v-if="errors.Codigo_Postal">{{errors.Codigo_Postal[0]}}</div>
                </div>
            </div>
            <div v-if="loading">
                <loading :active.sync="loading" :is-full-page="true"></loading>
            </div>
            <div v-if="curps.Codigo_Postal">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="estado">Estado</label>
                        <input type="text" v-model="this.curps.es" class="form-control" id="estado" ref="estado" placeholder="Estado" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="municipio">Municipio</label>
                        <input type="text" v-model="this.curps.muni" class="form-control" id="municipio" ref="municipio" placeholder="Municipio" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="colonia">Colonia</label>
                        <select class="form-control" :class="{'is-invalid': errors.Colonia}" v-model="curps.Colonia">
                          <option v-for="(colonia, key) in colonias" :value="key">{{colonia}}</option>
                          <div class="invalid-feedback" v-if="errors.Colonia">{{errors.Colonia[0]}}</div>

                        </select>
                        <!-- <cool-select v-model="curps.Colonia" :items="colonias" :error-message="this.colonia_E" placeholder="Seleccionar Colonia" /> -->
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="direccion">Dirección</label>
                        <input type="text" :class="{'is-invalid': errors.Direccion}" v-model="curps.Direccion" class="form-control" id="direccion" ref="direccion" placeholder="Dirección">
                        <div class="invalid-feedback" v-if="errors.Direccion">{{errors.Direccion[0]}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <button v-on:click="guardarProceso('2')"class="btn btn-primary float-right">Guardar Proceso</button>
                    </div>
                </div>

            </div>
        </tab-content>

        <tab-content title="Archivos" icon="fas fa-check">

            <div class="form-group col-md-12">
              <div class="form-row">
                <div class="custom-file col-md-6">
                    <label class="custom-file-label" for="archivoCurp">Seleccionar Archivo CURP</label>
                    <input class="custom-file-input" type="file" id="archivoCurp" :disabled="this.archivoCurp.length==1" ref="archivoCurp" accept="image/jpeg,image/png,application/pdf" v-on:change="generarCurp()" />
                    </label>
                </div>
                <div v-if="!this.archivoCurp.length" class="text-center col-md-6">No ha cargado ningún archivo</div>
                <div v-else class="col-md-6">
                    <table class="table table-striped">
                        <thead>
                        </thead>
                        <tbody>
                            <tr v-for="(file, key) in archivoCurp" scope="row">
                                <td>{{ file.name }}</td>
                                <td><span class="btn btn-danger btn-sm" v-on:click="removeArchivo( key, file.ruta, file.id, archivoCurp )"><span class="fas fa-times"></span> Borrar</span></td>
                                <td v-if="file.tipo"> <button class="btn btn-success btn-sm" v-on:click="getArchivo(file.name, 1)" name="button">Visualizar</button> </td>
                                <td v-if="file.tipo"> <button class="btn btn-success btn-sm" v-on:click="getArchivo(file.name, 2)" name="button">Descargar</button> </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
              </div>
            </div>

            <!-- Acta -->

            <div class="form-group col-md-12">
                <div class="form-row">
                    <div class="custom-file col-md-6">
                        <label class="custom-file-label" for="archivoActa">Seleccionar Archivo Acta de Nacimiento</label>
                        <input class="custom-file-input" type="file" id="archivoActa" :disabled="this.archivoActa.length==1" ref="archivoActa" accept="image/jpeg,image/png,application/pdf" v-on:change="generarActa()" />
                        </label>
                    </div>
            <div v-if="!this.archivoActa.length" class="text-center col-md-6">No a cargado ningún archivo</div>
            <div v-else class="col-md-6">
                <table class="table table-striped">
                    <thead>
                    </thead>
                    <tbody>
                        <tr v-for="(file, key) in archivoActa" scope="row">
                            <td>{{ file.name }}</td>
                            <td><span class="btn btn-danger btn-sm" v-on:click="removeArchivo( key, file.ruta, file.id, archivoActa )"><span class="fas fa-times"></span> Borrar</span></td>
                            <td v-if="file.tipo"> <button class="btn btn-success btn-sm" v-on:click="getArchivo(file.name, 1)" name="button">Visualizar</button> </td>
                            <td v-if="file.tipo"> <button class="btn btn-success btn-sm" v-on:click="getArchivo(file.name, 2)" name="button">Descargar</button> </td>

                        </tr>
                    </tbody>
                </table>
                </div>
              </div>
            </div>
            <!-- Certificado -->

            <div class="form-group col-md-12">
                <div class="form-row">
                    <div class="custom-file col-md-6">
                        <label class="custom-file-label" for="archivoCertificado">Seleccionar Archivo Certificado de Estudios</label>
                        <input class="custom-file-input" type="file" id="archivoCertificado" :disabled="this.archivoCertificado.length==1" ref="archivoCertificado" accept="image/jpeg,image/png,application/pdf" v-on:change="generarCertificado()" />
                        </label>
                    </div>
            <div v-if="!this.archivoCertificado.length" class="text-center col-md-6">No a cargado ningún archivo</div>
            <div v-else class="col-md-6">
                <table class="table table-striped">
                    <thead>
                    </thead>
                    <tbody>
                        <tr v-for="(file, key) in archivoCertificado" scope="row">
                            <td>{{ file.name }}</td>
                            <td><span class="btn btn-danger btn-sm" v-on:click="removeArchivo( key, file.ruta, file.id, archivoCertificado )"><span class="fas fa-times"></span> Borrar</span></td>
                            <td v-if="file.tipo"> <button class="btn btn-success btn-sm" v-on:click="getArchivo(file.name, 1)" name="button">Visualizar</button> </td>
                            <td v-if="file.tipo"> <button class="btn btn-success btn-sm" v-on:click="getArchivo(file.name, 2)" name="button">Descargar</button> </td>

                        </tr>
                      </tbody>
                  </table>
                  </div>
                </div>
              </div>

            <!-- Identificación -->

            <div class="form-group col-md-12">
                <div class="form-row">
                    <div class="custom-file col-md-6">
                        <label class="custom-file-label" for="archivoIdenti">Seleccionar Archivo Identificación Oficial</label>
                        <input class="custom-file-input" type="file" id="archivoIdenti" :disabled="this.archivoIdenti.length==1" ref="archivoIdenti" accept="image/jpeg,image/png,application/pdf" v-on:change="generarIdentifi()" />
                        </label>
                    </div>
            <div v-if="!this.archivoIdenti.length" class="text-center col-md-6">No a cargado ningún archivo</div>
            <div v-else class="col-md-6">
                <table class="table table-striped">
                    <thead>
                    </thead>
                    <tbody>
                        <tr v-for="(file, key) in archivoIdenti" scope="row">
                            <td>{{ file.name }}</td>
                            <td><span class="btn btn-danger btn-sm" v-on:click="removeArchivo( key, file.ruta, file.id, archivoIdenti )"><span class="fas fa-times"></span> Borrar</span></td>
                            <td v-if="file.tipo"> <button class="btn btn-success btn-sm" v-on:click="getArchivo(file.name, 1)" name="button">Visualizar</button> </td>
                            <td v-if="file.tipo"> <button class="btn btn-success btn-sm" v-on:click="getArchivo(file.name, 2)" name="button">Descargar</button> </td>

                          </tr>
                      </tbody>
                  </table>
                  </div>
                </div>
              </div>

            <!-- Comprobante -->

            <div class="form-group col-md-12">
                <div class="form-row">
                    <div class="custom-file col-md-6">
                        <label class="custom-file-label" for="archivoComproba">Seleccionar Archivo Comprobante de Domicilio</label>
                        <input class="custom-file-input" type="file" id="archivoComproba" :disabled="this.archivoComproba.length==1" ref="archivoComproba" accept="image/jpeg,image/png,application/pdf" v-on:change="generarComproba()" />
                        </label>
                    </div>
            <div v-if="!this.archivoComproba.length" class="text-center col-md-6">No a cargado ningún archivo</div>
            <div v-else class="col-md-6">
                <table class="table table-striped">
                    <thead>
                    </thead>
                    <tbody>
                        <tr v-for="(file, key) in archivoComproba" scope="row">
                            <td>{{ file.name }}</td>
                            <td><span class="btn btn-danger btn-sm" v-on:click="removeArchivo( key, file.ruta, file.id, archivoComproba )"><span class="fas fa-times"></span> Borrar</span></td>
                            <td v-if="file.tipo"> <button class="btn btn-success btn-sm" v-on:click="getArchivo(file.name, 1)" name="button">Visualizar</button> </td>
                            <td v-if="file.tipo"> <button class="btn btn-success btn-sm" v-on:click="getArchivo(file.name, 2)" name="button">Descargar</button> </td>

                          </tr>
                      </tbody>
                  </table>
                  </div>
                </div>
              </div>
        </tab-content>


        <div class="loader" v-if="loadingWizard"></div>

    </form-wizard>
</div>
</template>
<style>
span.error {
    color: #e74c3c;
    font-size: 20px;
    display: flex;
    justify-content: center;
}
</style>
<script>
import {
    CoolSelect
} from 'vue-cool-select'
import Loading from 'vue-loading-overlay'
// Vue.use(Loading);
// Import stylesheet
export default {
    components: {
        CoolSelect,
        Loading
    },
    data() {
        return {
            curps: {
                files: [],
                estado: null,
                municipio: null,
                count: 0,
                id: 0
            },
            cur: {
                files: [],
                count: 0,
                estado: null,
                municipio: null,
                id: 0
            },
            estados: {},
            paises: {},
            municipios: {},
            errors: ["null"],
            loadingWizard: false,
            errorMsg: null,
            loading: false,
            checked: false,
            count: 0,
            counts: 0,
            files: [],
            archivoCurp: [],
            archivoActa: [],
            archivoCertificado: [],
            archivoIdenti: [],
            archivoComproba: [],
            discapacidades: [],
            nivelE: ["Secundaria", "Media Superior"],
            domicilio: {
                colonias: []
            },
            colonias: [],
            archivo: ["CURP", "Acta de Nacimiento", "Certificado de Estudios", 'Identificación Oficial',
                "Comprobante de Domicilio"
            ]
        }
    },
    mounted() {
        this.getEstados()
        this.getPaises()
        this.getDiscapacidades()
    },
    methods: {
        onComplete: function() {
            this.errors = [];
            this.$swal({
                title: '¿Deseas Completar el Registro?',
                text: "Verifica Que Los Archivos y Datos Sean Correctos!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si Deseo Registrarme!',
                cancelButtonText: 'Cancelar'
            }).then((willDelete) => {
                if (willDelete.value) {
                    let loader = this.$loading.show({
                        container: this.fullPage ? null : this.$refs.formContainer,
                        canCancel: true,
                        onCancel: this.onCancel,
                    });
                    return new Promise((resolve, reject) => {
                        setTimeout(() => {
                            let formData = new FormData();
                            if (this.archivoCurp) {
                                formData.append('tipo1', "Curp");
                                for (var i = 0; i < this.archivoCurp.length; i++) {
                                    let file = this.archivoCurp[i];
                                    formData.append('curp[' + i + ']', file);
                                }
                            }
                            if (this.archivoActa) {
                                formData.append('tipo2', "Acta");
                                for (var i = 0; i < this.archivoActa.length; i++) {
                                    let file = this.archivoActa[i];
                                    formData.append('acta[' + i + ']', file);
                                }
                            }
                            if (this.archivoCertificado) {
                                formData.append('tipo3', "Certificado");
                                for (var i = 0; i < this.archivoCertificado.length; i++) {
                                    let file = this.archivoCertificado[i];
                                    formData.append('certificado[' + i + ']', file);
                                }
                            }
                            if (this.archivoIdenti) {
                                formData.append('tipo4', "Identificación");
                                for (var i = 0; i < this.archivoIdenti.length; i++) {
                                    let file = this.archivoIdenti[i];
                                    formData.append('identificacion[' + i + ']', file);
                                }
                            }
                            if (this.archivoComproba) {
                                formData.append('tipo5', "Comprobante");
                                for (var i = 0; i < this.archivoComproba.length; i++) {
                                    let file = this.archivoComproba[i];
                                    formData.append('comprobante[' + i + ']', file);
                                }
                            }
                            formData.append('Curp', this.curps["Curp"]);
                            formData.append('id', this.curps.id);
                            axios.post(`/api/aspirantes/preregistrar/`,
                                    formData, {
                                        headers: {
                                            'Content-Type': 'multipart/form-data'
                                        }
                                    }
                                ).then(response => {})
                                .catch(error => {
                                    this.errors = error.response.data.errors
                                })
                                .finally(() => {})
                            var curp = this.curps;
                            curp.count = 4;
                            axios.post(`/api/aspirantes/preregistrar/`, curp)
                                .then(response => {
                                    for (var i = 0; i < response.data.archivos.length; i++) {
                                        if (response.data.archivos[i].tipo == "Curp") {
                                            this.archivoCurp.length = [];
                                            this.archivoCurp.push(response.data.archivos[i]);
                                        }
                                        if (response.data.archivos[i].tipo == "Acta") {
                                            this.archivoActa.length = [];
                                            this.archivoActa.push(response.data.archivos[i]);
                                        }
                                        if (response.data.archivos[i].tipo == "Certificado") {
                                            this.archivoCertificado.length = [];
                                            this.archivoCertificado.push(response.data.archivos[i]);
                                        }
                                        if (response.data.archivos[i].tipo == "Identificación") {
                                            this.archivoIdenti.length = [];
                                            this.archivoIdenti.push(response.data.archivos[i]);
                                        }
                                        if (response.data.archivos[i].tipo == "Comprobante") {
                                            this.archivoComproba.length = [];
                                            this.archivoComproba.push(response.data.archivos[i]);
                                        }
                                    }
                                    if (response.data.arch) {
                                        this.$swal({
                                            title: 'Advertencia!',
                                            text: 'Te Faltan Archivos Por Subir!',
                                            type: 'warning',
                                            confirmButtonText: 'Aceptar'
                                        })

                                    } else {
                                        this.$swal({
                                            title: 'Correcto!',
                                            html: 'Has Sido Pre-registrado Correctamente!<br>Se Te Ha Enviado Un Mensaje de Bienvenida!',
                                            type: 'success',
                                            confirmButtonText: 'Aceptar'
                                        })

                                    }
                                })
                                .catch(error => {
                                    loader.hide()
                                    this.errors = error.response.data.errors
                                })
                                .finally(() => loader.hide())
                        }, 1000)
                    })
                }
            })
        },
        generarCurp() {
            let curpss = this.$refs.archivoCurp.files;
            for (var i = 0; i < curpss.length; i++) {
                this.archivoCurp.push(curpss[i]);
            }
        },
        generarActa() {
            let actass = this.$refs.archivoActa.files;
            for (var i = 0; i < actass.length; i++) {
                this.archivoActa.push(actass[i]);
            }
        },
        generarCertificado() {
            let certificado = this.$refs.archivoCertificado.files;
            for (var i = 0; i < certificado.length; i++) {
                this.archivoCertificado.push(certificado[i]);
            }
        },
        generarComproba() {
            let comprobante = this.$refs.archivoComproba.files;
            for (var i = 0; i < comprobante.length; i++) {
                this.archivoComproba.push(comprobante[i]);
            }
        },
        generarIdentifi() {
            let identificacion = this.$refs.archivoIdenti.files;
            for (var i = 0; i < identificacion.length; i++) {
                this.archivoIdenti.push(identificacion[i]);
            }
        },
        removeArchivo(key, file, id, arrays) {
            let formData = new FormData();
            formData.append("file", file);
            formData.append("id", id);
            axios.post(`/api/archivos/eliminar`, formData)
                .then(response => {})
            arrays.splice(key, 1);
        },
        // removeActa(key, file, id) {
        //     let formData = new FormData();
        //     formData.append("file", file);
        //     formData.append("id", id);
        //     axios.post(`/api/archivos/eliminar`, formData)
        //         .then(response => {})
        //     this.archivoActa.splice(key, 1);
        // },
        // removeCertificado(key, file, id) {
        //     let formData = new FormData();
        //     formData.append("file", file);
        //     formData.append("id", id);
        //     axios.post(`/api/archivos/eliminar`, formData)
        //         .then(response => {})
        //     this.archivoCertificado.splice(key, 1);
        // },
        // removeComproba(key, file, id) {
        //     let formData = new FormData();
        //     formData.append("file", file);
        //     formData.append("id", id);
        //     axios.post(`/api/archivos/eliminar`, formData)
        //         .then(response => {})
        //     this.archivoComproba.splice(key, 1);
        // },
        // removeIdenti(key, file, id) {
        //     let formData = new FormData();
        //     formData.append("file", file);
        //     formData.append("id", id);
        //     axios.post(`/api/archivos/eliminar`, formData)
        //         .then(response => {})
        //     this.archivoIdenti.splice(key, 1);
        // },
        getCodigo() {
            this.errors = [];
            this.loading = true;
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    let formData = new FormData();
                    if (Number(this.curps.Codigo_Postal)) {
                        formData.append("Codigo", this.curps.Codigo_Postal);
                        axios.post('/api/codigop/codigo', formData)
                            .then(response => {
                                this.colonias = null;
                                this.domicilio = response.data;
                                this.curps.estado = this.domicilio.estado;
                                this.curps.municipio = this.domicilio.municipio;
                                this.curps.es = response.data.es;
                                this.curps.muni = response.data.muni;
                                if (this.domicilio.municipio) {
                                    this.colonias = this.domicilio.colonias;
                                    this.loading = false;
                                } else {
                                    this.$swal({
                                        title: 'Incorrecto!',
                                        text: "Código Postal No Existe",
                                        type: 'warning',
                                        confirmButtonText: 'Aceptar'
                                    })
                                }
                            })
                            .catch(error => {
                                this.errors = error.response.data.errors
                            })
                            .finally(() => this.loading = false)
                    } else {
                        this.$swal({
                            title: 'Incorrecto!',
                            text: "Código Postal Solo Debe Contener Números",
                            type: 'warning',
                            confirmButtonText: 'Aceptar'
                        })
                        this.loading = false
                    }
                }, 1000)
            })
        },
        setLoading: function(value) {
            this.loadingWizard = value
        },
        handleValidation: function(isValid, tabIndex) {
            // console.log('Tab: ' + tabIndex + ' valid: ' + i
        },
        handleErrorMessage: function(errorMsg) {
            this.errorMsg = errorMsg
        },
        //#Region Validar{
        validarCampos: function() {
            this.errors = [];
            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel: true,
                onCancel: this.onCancel,
            });
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    var curp = this.curps;
                    curp.count = 1;
                    if (this.checked) {
                        if (curp.discapacidad_id) {
                            curp['Discapacidad'] = 1;
                        }
                    } else {
                        curp.discapacidad_id = null;
                        curp['Discapacidad'] = 0;
                    }
                    axios.post(`/api/aspirantes/preregistrar/`, curp)
                        .then(response => {
                            resolve(true);
                            this.curps.id = response.data.id;
                        })
                        .catch(error => {
                            this.errors = error.response.data.errors
                            reject(true);
                        })
                        .finally(() => loader.hide())
                }, 1000)
            })
        },
        validarTerminos: function() {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    if (this.$refs.terminos.checked == true) {
                        resolve(true)
                    } else {
                        this.$swal({
                            type: 'error',
                            title: 'Error',
                            text: 'No Aceptó Los Terminos y Condiciones!',
                        })
                        reject('No aceptó los terminos y condiciones');
                    }
                }, 1000)
            })
        },
        validarCurp: function() {
            this.errors = [];
            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel: true,
                onCancel: this.onCancel,
            });
            this.curps = null;
            this.curps = this.cur;
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    if (this.$refs.curp.value.length == 18) {
                        let formData = new FormData();
                        formData.append('curp', this.$refs.curp.value);
                        axios.post('/api/aspirantes/curp', formData)
                            .then(response => {
                                this.curps = response.data
                                resolve(true);
                                this.checked = response.data.Discapacidad;
                                this.curps.id = response.data.id;
                                this.curps.PaisNacimiento = response.data.PaisNacimiento;
                                if (this.curps.Codigo_Postal) {
                                    this.getCodigo();
                                }
                                if (this.curps.municipio_id != null) {
                                    this.getMunicipios();
                                }
                                for (var i = 0; i < response.data.archivos.length; i++) {
                                    if (response.data.archivos[i].tipo == "Curp") {
                                        this.archivoCurp[0] = response.data.archivos[i];
                                    }
                                    if (response.data.archivos[i].tipo == "Acta") {
                                        this.archivoActa[0] = response.data.archivos[i];
                                    }
                                    if (response.data.archivos[i].tipo == "Certificado") {
                                        this.archivoCertificado[0] = response.data.archivos[i];
                                    }
                                    if (response.data.archivos[i].tipo == "Identificación") {
                                        this.archivoIdenti[0] = response.data.archivos[i];
                                    }
                                    if (response.data.archivos[i].tipo == "Comprobante") {
                                        this.archivoComproba[0] = response.data.archivos[i];
                                    }
                                }
                            })
                            .catch(error => {
                                if (error) {
                                    reject(true);
                                    if (error.response.status == 500) {
                                        this.$swal({
                                            title: 'Incorrecto!',
                                            text: 'La CURP No Existe',
                                            type: 'warning',
                                            confirmButtonText: 'Aceptar'
                                        })
                                    }
                                }
                            })
                            .finally(() => {
                                this.loading = false
                                loader.hide();
                            })
                    } else {
                        if (this.$refs.curp.value.length < 18) {
                            this.$swal({
                                title: 'Incorrecto!',
                                text: 'La CURP Debe Contener 18 Caracteres',
                                type: 'warning',
                                confirmButtonText: 'Aceptar'
                            })
                            loader.hide();
                        }
                        reject('Ingrese su CURP');
                    }
                }, 1000)
            })
        },
        validarEscolar: function() {
            this.errors = [];
            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel: true,
                onCancel: this.onCancel,
            });
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    var curp = this.curps;
                    curp.count = 2;
                    if (curp.pais_id != 4142) {
                        curp.municipio_id = null;
                        curp.estado_id = null;
                    }
                    axios.post(`/api/aspirantes/preregistrar/`, curp)
                        .then(response => {
                            resolve(true);
                            this.curps.id = response.data.id;
                        })
                        .catch(error => {
                            this.errors = error.response.data.errors
                            reject(true);
                        })
                        .finally(() => loader.hide())
                }, 1000)
            })
        },
        validarDomicilio: function() {
            this.errors = [];
            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel: true,
                onCancel: this.onCancel,
            });
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    var curp = this.curps;
                    curp.Codigo_Postal = this.curps.Codigo_Postal;
                    curp.count = 3;
                    axios.post(`/api/aspirantes/preregistrar/`, curp)
                        .then(response => {
                            resolve(true);
                            this.curps.id = response.data.id;
                        })
                        .catch(error => {
                            this.errors = error.response.data.errors
                            reject(true);
                        })
                        .finally(() => {
                            loader.hide()
                        })
                }, 1000)
            })
        },
        //#endregion
        getCurrentYear() {
            return new Date().getFullYear();
        },
        guardarProceso: function(count) {
            this.errors = [];
            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel: true,
                onCancel: this.onCancel,
            });
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    var curp = this.curps;
                    curp.Codigo_Postal = this.curps.Codigo_Postal;
                    if (curp.pais_id != 4142) {
                        curp.municipio_id = null;
                        curp.estado_id = null;
                    }
                    if (this.checked) {
                        if (curp.discapacidad_id) {
                            curp['Discapacidad'] = 1;
                        }
                    } else {
                        curp.discapacidad_id = null;
                        curp['Discapacidad'] = 0;
                    }
                    axios.post(`/api/aspirantes/guardar/`, curp)
                        .then(response => {
                            // resolve(true);
                            this.curps.id = response.data.id;
                        })
                        .catch(error => {
                            this.errors = error.response.data.errors
                            reject(true);
                        })
                        .finally(() => loader.hide())
                }, 1000)
            })
        },
        getEstados: function() {
            axios.get(`/api/entidades/entidad`)
                .then(response => {
                    this.estados = response.data
                })
        },
        getPaises: function() {
            axios.get(`/api/paises/pais`)
                .then(response => {
                    this.paises = response.data
                })
        },
        getMunicipios: function() {
            this.municipios = null;
            axios.post(`/api/poblaciones/poblacion`, this.curps.estado_id)
                .then(response => {
                    this.municipios = response.data
                })
        },
        getDiscapacidades: function() {
            axios.get(`/api/discapacidades/discapacidad`)
                .then(response => {
                    this.discapacidades = response.data
                })
        },
        getArchivo: function(files, opcion) {
            let formData = new FormData();
            let file = this.curps.Curp + "/" + files;
            formData.append("file", file);
            if (opcion == 1) {
                axios({
                    url: '/api/archivos/visualizar',
                    method: 'POST',
                    data: formData,
                    responseType: 'blob', // important
                }).then((response) => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    window.open(url, '_blank');
                });
            } else {
                axios({
                    url: '/api/archivos/visualizar',
                    method: 'POST',
                    data: formData,
                    responseType: 'blob', // important
                }).then((response) => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', files);
                    document.body.appendChild(link);
                    link.click();
                });
            }
        }
    }
}
</script>
