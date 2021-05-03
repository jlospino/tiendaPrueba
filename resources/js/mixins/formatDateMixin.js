export default {
    methods: {
        formatDate(value) {
            let date = new Date(value)

            let day = date.getDate() + 1
            let month = date.getMonth() + 1
            let year = date.getFullYear()

            if(month < 10){
              date = `0${day}/0${month}/${year}`
            }else{
                date = `${day}-${month}-${year}`
            }
            return date;
        }
    }
  };
