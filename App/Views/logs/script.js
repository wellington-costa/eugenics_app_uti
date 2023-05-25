const axios = require('axios');

// Configurações do servidor GenieACS
const acsUrl = 'http://170.244.16.30:7547';
const acsUsername = 'vips';
const acsPassword = 'modelight';

// Parâmetros de busca para encontrar dispositivos MikroTik
const searchParams = {
  query: {
    'InternetGatewayDevice.DeviceInfo.Manufacturer': 'MikroTik',
  },
  projection: {
    _id: 1,
  },
};

// Função para buscar dispositivos MikroTik no servidor GenieACS
async function searchMikroTikDevices() {
  try {
    const response = await axios.get(`${acsUrl}/devices`, {
      auth: {
        username: acsUsername,
        password: acsPassword,
      },
      params: searchParams,
    });

    if (response.status === 200) {
      const devices = response.data;
      if (devices.length > 0) {
        console.log('Dispositivos MikroTik encontrados:');
        devices.forEach((device) => {
          const deviceId = device._id;
          console.log('- Device ID:', deviceId);
        });
      } else {
        console.log('Nenhum dispositivo MikroTik encontrado.');
      }
    } else {
      console.log('Falha ao buscar dispositivos MikroTik no GenieACS. Código de status:', response.status);
    }
  } catch (error) {
    console.error('Erro ao buscar dispositivos MikroTik:', error.message);
  }
}

// Chama a função de busca de dispositivos MikroTik
searchMikroTikDevices();
