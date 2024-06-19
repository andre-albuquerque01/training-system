import { cookies } from 'next/headers'

export function VerifyAuth() {
  const token = cookies().get('token')?.value
  return !!token
}
