<template>
  <div>
    <br>
    <div class="form-row">
      <div class="col-md-10 col-sm-12">
        <h3>Reactivos creados</h3>
      </div>
      <div class="col-md-2 col-sm-12">
        <router-link :to="{ name: 'reactivo.create' }">
          <button type="submit" class="btn btn-primary btn-block">Crear reactivo</button>
        </router-link>
      </div>
    </div>
    <hr>

    <card-transition>
      <div
        class="card mb-5 col-md-10 col-sm-12"
        align="center"
        style="margin: auto;"
        v-for="reactivo in reactivos"
        :key="reactivo.id"
      >
        <div class="card-body">
          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Profesor</th>
                <th
                  scope="col"
                >{{ reactivo.relationships['autor'].name + " " + reactivo.relationships['autor'].apellido }}</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <th>Nivel</th>
                <td>{{ reactivo.relationships['nivel'].materia }}</td>
              </tr>

              <tr>
                <th>Unidad</th>
                <td>{{ reactivo.relationships['punto_gramatical'].unidad }}</td>
              </tr>

              <tr>
                <th>Punto Gramatical</th>
                <td>{{ reactivo.relationships['punto_gramatical'].punto_gramatical }}</td>
              </tr>

              <tr>
                <th>Reactivo para</th>
                <td>{{ reactivo.relationships['catalogo'].catalogo }}</td>
              </tr>

              <tr>
                <th>Competencia</th>
                <td>{{ reactivo.relationships['competencia'].competencia }}</td>
              </tr>
              <tr>
                <th>Tipo Reactivo</th>
                <td>{{ reactivo.relationships['tipo_reactivo'].tipo }}</td>
              </tr>

              <template v-if="reactivo.relationships.text">
                <tr>
                  <th>Texto/Url</th>
                  <td>{{ reactivo.relationships['text'].texto }}</td>
                </tr>
              </template>

              <tr>
                <th>Pregunta</th>
                <td>{{ reactivo.attributes.pregunta }}</td>
              </tr>

              <tr class="table-success">
                <th>Respuesta</th>
                <td>{{ reactivo.attributes.respuesta }}</td>
              </tr>

              <tr v-for="(value, key, index) in reactivo.relationships['opciones'].opciones">
                <th>Opción {{ index }}</th>
                <td>{{ value.opcion }}</td>
              </tr>
              <tr>
                <th>Estado</th>
                <td>{{ reactivo.relationships['estatus_reactivo'].estatus }}</td>
              </tr>
              <tr v-if="reactivo.relationships['estatus_reactivo'].estatus == 'Comentario'">
                <th>Comentario</th>
                <td>{{getComentario(reactivo.id)}} {{ reactivo.comentario }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </card-transition>

    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{ disabled: !pagination.prev_page_url }]" class="page-item">
          <a
            @click="fetchReactivos(pagination.prev_page_url + '&by=1')"
            class="page-link"
            href="#"
          >Previous</a>
        </li>

        <li
          v-for="n in pagination.last_page"
          v-bind:class="[{ active: pagination.current_page==n}]"
          class="page-item"
        >
          <a @click="fetchReactivos(pagination.url+ n +'&by=1')" class="page-link" href="#">{{ n }}</a>
        </li>

        <li v-bind:class="[{ disabled: !pagination.next_page_url }]" class="page-item">
          <a
            @click="fetchReactivos(pagination.next_page_url + '&by=1' )"
            class="page-link"
            href="#"
          >Next</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  data() {
    return {
      pagination: {},
      reactivos: []
    };
  },
  created() {
    this.fetchReactivos();
  },
  methods: {
    fetchReactivos(page_url = "/api/reactivos?by=1") {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log(response.data);
          this.reactivos = response.data.data.reactivos;
          vm.makePagination(response.data.meta, response.data.links);
        })
        .catch(e => {
          console.log(e);
        });
    },

    getComentario(id) {
      console.log(id);
      let vm = this;

      axios
        .get("/api/comentarios?byReactivo=" + id)
        .then(response => {
          console.log(response.data[0]);
          for (let index = 0; index < this.reactivos.length; index++) {
            if ((this.reactivos[index].id = id)) {
              this.reactivos[index].comentario = response.data[0];
            } else {
              return "";
            }
          }
          return response.data[0];
          /* this.reactivos = response.data.data.reactivos;
          vm.makePagination(response.data.meta, response.data.links); */
        })
        .catch(e => {
          console.log(e);
        });
    },

    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev,
        prev_next_url: links.prev_next_url,
        url: meta.path + "?page="
      };

      this.pagination = pagination;
    }
  }
};
</script>