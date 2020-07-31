<template>
    <select name="variations[]" class="form-control" required>
        <option value="">{{translation}}</option>
        <option v-for="attr in listAttributes" :selected="item['id'] == attr['id']" :key="attr.id + fam.id" :value="attr.id">{{attr.name[locale]}}</option>
    </select>
</template>

<script>
export  default {
    name: 'select-variation',
    props: ['translation', 'item', 'fam', 'attributes', 'locale'],
    data() {
        return {}
    },
    computed: {
        listAttributes: function () {
            return this.attributes.filter((attr) => {
              var thi = this;
              for(var i = 0; i <= thi.attributes.length; i++) {
                    if(thi.fam.id == attr.family_id) {
                        return attr;
                    }
              }
          })
      }
    },
    methods: {

    }
}
</script>
