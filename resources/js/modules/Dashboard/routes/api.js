export default {
  list: () =>  '/api/v1/sessions',
  store: () => '/api/v1/sessions',
  update: id => `/api/v1/sessions/${id}`,
  log: () => `/api/v1/sessions/log`,
}
