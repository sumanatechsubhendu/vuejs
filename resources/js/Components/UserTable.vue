<template>
    <div>
      <table class="min-w-full divide-y divide-gray-200">
        <thead>
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              ID
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Name
            </th>
            <!-- Add more columns as needed -->
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td class="px-6 py-4 whitespace-nowrap">{{ user.id }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ user.first_name }}</td>
            <!-- Add more columns as needed -->
          </tr>
        </tbody>
      </table>
    </div>
  </template>

  <script>
  export default {
    props: {
      users: Array, // Pass the list of users as a prop
    },
  };
  </script>
