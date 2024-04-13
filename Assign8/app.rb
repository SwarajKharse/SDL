require 'sinatra'
# Method to reverse each string in the array and combine them
def reverse_and_combine(array)
 array.map(&:reverse).join(' ')
end
get '/' do
 erb :index_array
end
post '/reverse_combine' do
 array = params.values_at('string0', 'string1', 'string2', 'string3', 'string4')
 @combined_string = reverse_and_combine(array)
 erb :reverse_combine
end
