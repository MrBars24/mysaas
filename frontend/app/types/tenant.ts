export type TenantStatus = 'pending' | 'approved' | 'rejected' | 'under_review'

export interface Tenant {
  id: string
  name: string
  business_type: string
  email: string
  plan: string
  created_at: string
  status: TenantStatus
  notes?: string
}