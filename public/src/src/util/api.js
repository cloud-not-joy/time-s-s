import axios from 'axios'
const baseUrl = 'http://time.mimicpark.tech'

function makeGet (url) {
  return (data) => {
    return axios.get(baseUrl + url, {
      params: data
    }).catch((err) => {
      alert(err)
    })
  }
}

function makePost (url) {
  return (data) => {
    return axios.post(baseUrl + url, {
      data: data
    }).catch((err) => {
      alert(err)
    })
  }
}

const userInfo = makeGet('/api/user')
const userJoin = makePost('/api/join')

export default {
  userInfo,
  userJoin
}
