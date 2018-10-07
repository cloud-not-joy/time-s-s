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
    return axios.post(baseUrl + url, data).catch((err) => {
      alert(err)
    })
  }
}

const userInfo = makeGet('/api/user_info')
const userJoin = makePost('/api/join')
const userShare = makeGet('/api/ticket')
const joinUsers = makeGet('/api/join_users')
const help = makePost('/api/help')

export default {
  userInfo,
  userJoin,
  userShare,
  joinUsers,
  help
}
