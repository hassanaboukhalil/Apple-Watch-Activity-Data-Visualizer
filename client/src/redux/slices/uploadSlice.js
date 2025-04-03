import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';
import axios from 'axios';


const url = "http://127.0.0.1:8000/api/v1";

export const uploadCSV = createAsyncThunk(
  'uploadCSV',
  async ({ file, user_id }) => {
    try {
      const formData = new FormData();
      formData.append('file', file);
      formData.append('user_id', user_id);

      const response = await axios.post(url + '/uploadcsv', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

      return response.data;
    } catch (error) {
      console.log('Upload failed');
      console.log(error)
    }
  }
);

const uploadSlice = createSlice({
  name: 'upload',
  initialState: {
    loading: false,
    success: false,
    error: null,
    message: '',
  },
  reducers: {
  },
});

export const { resetUploadState } = uploadSlice.actions;
export default uploadSlice.reducer;
