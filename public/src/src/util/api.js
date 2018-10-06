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

const userInfo = makeGet('/api/user_info')
const userJoin = makePost('/api/join')
const userShare = makeGet('/api/ticket')

export default {
  userInfo,
  userJoin,
  userShare
}
